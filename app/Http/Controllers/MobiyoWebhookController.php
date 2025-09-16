<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AutologToken;
use App\Models\WebhookLog;
use App\Models\Transaction;
use App\Services\MobiyoSignature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MobiyoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $params = $request->query();
        $startTime = microtime(true);

        // 1. Log du webhook reçu
        $webhookLog = WebhookLog::create([
            'provider' => 'mobiyo',
            'action' => $params['action'] ?? 'unknown',
            'transaction_id' => $params['transaction_id'] ?? null,
            'subscriber_reference' => $params['subscriber_reference'] ?? null,
            'msisdn' => $params['msisdn'] ?? null,
            'status' => $params['status'] ?? null,
            'status_description' => $params['status_description'] ?? null,
            'amount' => $params['amount'] ?? null,
            'currency' => $params['currency'] ?? null,
            'customer_country' => $params['customer_country'] ?? null,
            'carrier' => $params['carrier'] ?? null,
            'merchant_subscriber_reference' => $params['merchant_subscriber_reference'] ?? null,
            'site_id' => $params['site_id'] ?? null,
            'product_id' => $params['product_id'] ?? null,
            'offer_id' => $params['offer_id'] ?? null,
            'pricepoint_id' => $params['pricepoint_id'] ?? null,
            'payment_method' => $params['type'] ?? null,
            'transaction_date' => $params['date'] ? Carbon::parse($params['date']) : null,
            'raw_data' => $params,
            'signature_valid' => false,
            'error_message' => null,
        ]);

        // 2. Vérification de la signature
        $signatureValid = MobiyoSignature::verify($params, config('mobiyo.secret'));
        $webhookLog->update(['signature_valid' => $signatureValid]);

        if (!$signatureValid) {
            $webhookLog->update(['error_message' => 'Signature invalide']);
            Log::warning('Mobiyo webhook: signature invalide', ['webhook_id' => $webhookLog->id]);
            return $this->xmlResponse(1, 'KO (bad signature)');
        }

        // 3. Traitement selon l'action
        try {
            $action = $params['action'];
            $transaction = null;

            switch ($action) {
                case 'payment-confirm':
                    $transaction = $this->handlePaymentConfirm($request, $webhookLog);
                    break;

                case 'payment-renewal':
                    $transaction = $this->handlePaymentRenewal($request, $webhookLog);
                    break;

                case 'subscription-cancellation':
                    $transaction = $this->handleCancellation($request, $webhookLog);
                    break;

                default:
                    Log::warning('Mobiyo webhook: action inconnue', ['action' => $action, 'webhook_id' => $webhookLog->id]);
                    $webhookLog->update(['error_message' => 'Action inconnue: ' . $action]);
                    return $this->xmlResponse(1, 'KO (action inconnue)');
            }

            // 4. Mise à jour du log avec l'ID de la transaction
            if ($transaction) {
                $webhookLog->update(['transaction_id' => $transaction->transaction_id]);
            }

            $processingTime = round((microtime(true) - $startTime) * 1000, 2);
            Log::info('Mobiyo webhook traité avec succès', [
                'webhook_id' => $webhookLog->id,
                'action' => $action,
                'processing_time_ms' => $processingTime,
                'transaction_id' => $transaction?->id
            ]);

        } catch (\Throwable $e) {
            $webhookLog->update(['error_message' => $e->getMessage()]);
            Log::error('Mobiyo webhook error', [
                'webhook_id' => $webhookLog->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->xmlResponse(1, 'KO (server error)');
        }

        return $this->xmlResponse(0, 'OK');
    }

    protected function handlePaymentConfirm(Request $r, WebhookLog $webhookLog): Transaction
    {
        $subscriberRef = $r->query('subscriber_reference');
        $msisdn = $this->normalizeMsisdn($r->query('msisdn'));
        $date = $r->query('date');
        $transactionId = $r->query('transaction_id');

        // Créer ou mettre à jour l'utilisateur
        $user = User::firstOrCreate(
            ['subscription_id' => $subscriberRef],
            [
                'login' => $this->deriveLogin($msisdn, $subscriberRef),
                'email' => $this->deriveEmail($msisdn, $subscriberRef),
                'password' => Hash::make(Str::random(24)),
                'msisdn' => $msisdn,
                'subscribed' => true,
                'credit_ia' => 100, // Crédits initiaux
                'last_rebill_at' => $date ? Carbon::parse($date) : now(),
            ]
        );

        // Mise à jour si l'utilisateur existait
        $user->fill([
            'msisdn' => $user->msisdn ?: $msisdn,
            'subscribed' => true,
            'last_rebill_at' => $date ? Carbon::parse($date) : now(),
        ])->save();

        // Créer la transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'provider' => 'mobiyo',
            'action' => 'payment-confirm',
            'transaction_id' => $transactionId,
            'subscriber_reference' => $subscriberRef,
            'status' => $r->query('status'),
            'status_description' => $r->query('status_description'),
            'amount' => $r->query('amount'),
            'currency' => $r->query('currency'),
            'customer_country' => $r->query('customer_country'),
            'transaction_date' => $date ? Carbon::parse($date) : now(),
            'metadata' => [
                'msisdn' => $msisdn,
                'carrier' => $r->query('carrier'),
                'site_id' => $r->query('site_id'),
                'product_id' => $r->query('product_id'),
                'offer_id' => $r->query('offer_id'),
                'pricepoint_id' => $r->query('pricepoint_id'),
                'payment_method' => $r->query('type'),
            ],
        ]);

        // Générer le token autolog
        AutologToken::issueFor($user, (int) config('mobiyo.autolog_ttl'));

        Log::info('Mobiyo payment-confirm OK', [
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
            'subscriber_ref' => $subscriberRef
        ]);

        return $transaction;
    }

    protected function handlePaymentRenewal(Request $r, WebhookLog $webhookLog): Transaction
    {
        $subscriberRef = $r->query('subscriber_reference');
        $transactionId = $r->query('transaction_id');
        $date = $r->query('date');

        $user = User::where('subscription_id', $subscriberRef)->first();
        if ($user) {
            $user->update([
                'subscribed' => true,
                'last_rebill_at' => $date ? Carbon::parse($date) : now(),
                'credit_ia' => $user->credit_ia + 100, // +100 crédits à chaque renouvellement
            ]);
        }

        $transaction = Transaction::create([
            'user_id' => $user?->id,
            'provider' => 'mobiyo',
            'action' => 'payment-renewal',
            'transaction_id' => $transactionId,
            'subscriber_reference' => $subscriberRef,
            'status' => $r->query('status'),
            'status_description' => $r->query('status_description'),
            'amount' => $r->query('amount'),
            'currency' => $r->query('currency'),
            'customer_country' => $r->query('customer_country'),
            'transaction_date' => $date ? Carbon::parse($date) : now(),
            'metadata' => [
                'msisdn' => $r->query('msisdn'),
                'carrier' => $r->query('carrier'),
                'site_id' => $r->query('site_id'),
                'product_id' => $r->query('product_id'),
                'offer_id' => $r->query('offer_id'),
                'pricepoint_id' => $r->query('pricepoint_id'),
                'payment_method' => $r->query('type'),
            ],
        ]);

        return $transaction;
    }

    protected function handleCancellation(Request $r, WebhookLog $webhookLog): Transaction
    {
        $subscriberRef = $r->query('subscriber_reference');
        $transactionId = $r->query('transaction_id');
        $date = $r->query('date');

        $user = User::where('subscription_id', $subscriberRef)->first();
        if ($user) {
            $user->update([
                'subscribed' => false,
                'unsub_at' => $date ? Carbon::parse($date) : now(),
            ]);
        }

        $transaction = Transaction::create([
            'user_id' => $user?->id,
            'provider' => 'mobiyo',
            'action' => 'subscription-cancellation',
            'transaction_id' => $transactionId,
            'subscriber_reference' => $subscriberRef,
            'status' => $r->query('status'),
            'status_description' => $r->query('status_description'),
            'amount' => $r->query('amount'),
            'currency' => $r->query('currency'),
            'customer_country' => $r->query('customer_country'),
            'transaction_date' => $date ? Carbon::parse($date) : now(),
            'metadata' => [
                'msisdn' => $r->query('msisdn'),
                'carrier' => $r->query('carrier'),
                'site_id' => $r->query('site_id'),
                'product_id' => $r->query('product_id'),
                'offer_id' => $r->query('offer_id'),
                'pricepoint_id' => $r->query('pricepoint_id'),
                'payment_method' => $r->query('type'),
            ],
        ]);

        return $transaction;
    }

    protected function xmlResponse(int $code, string $message)
    {
        return response(
            '<?xml version="1.0" encoding="UTF-8" ?>' .
            '<response status="' . ($code === 0 ? '0' : '1') . '">' .
            '<code>' . $code . '</code>' .
            '<message>' . e($message) . '</message>' .
            '</response>',
            200,
            ['Content-Type' => 'application/xml; charset=UTF-8']
        );
    }

    private function deriveLogin(?string $msisdn, string $subscriberRef): string
    {
        if ($msisdn) return $msisdn;
        return 'u' . substr(preg_replace('/\D/', '', $subscriberRef), -8);
    }

    private function deriveEmail(?string $msisdn, string $subscriberRef): string
    {
        $login = $this->deriveLogin($msisdn, $subscriberRef);
        return $login . '@example.test';
    }

    private function normalizeMsisdn(?string $msisdn): ?string
    {
        if (!$msisdn) return null;
        $n = preg_replace('/\D+/', '', $msisdn);
        if (str_starts_with($n, '33') && strlen($n) === 11) {
            return '0' . substr($n, 2);
        }
        return $n;
    }
}
