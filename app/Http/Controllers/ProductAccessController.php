<?php 

// app/Http/Controllers/ProductAccessController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAccessController extends Controller
{
    public function access(Request $request)
    {
        $subscriberRef = $request->query('subscriber_reference');

        if ($subscriberRef) {
            $user = User::where('subscription_id', $subscriberRef)->first();

            // Sécurité minimale : on n’autolog que si abonnement actif et récent
            if ($user && $user->subscribed &&
                ($user->created_at?->gt(now()->subMinutes(config('mobiyo.product_access_grace'))) ||
                 $user->last_rebill_at?->gt(now()->subMinutes(config('mobiyo.product_access_grace'))))
            ) {
                Auth::login($user, remember: true);
                return redirect()->route('dashboard')->with('success', 'Connexion automatique réussie.');
            }
        }

        // Fallback : on affiche une page d’attente
        return view('product-access-pending');
    }
}
