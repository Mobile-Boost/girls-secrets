<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('provider'); // 'mobiyo', 'allopass', etc.
            $table->string('action'); // 'payment-confirm', 'payment-renewal', 'subscription-cancellation'
            $table->string('transaction_id')->nullable(); // ID transaction Mobiyo
            $table->string('subscriber_reference')->nullable(); // Référence abonné
            $table->string('msisdn')->nullable(); // Numéro de téléphone
            $table->string('status')->nullable(); // Code statut (0, 1, 5)
            $table->string('status_description')->nullable(); // Description du statut
            $table->decimal('amount', 10, 2)->nullable(); // Montant de la transaction
            $table->string('currency', 3)->nullable(); // Devise (EUR, etc.)
            $table->string('customer_country', 2)->nullable(); // Code pays (FR, etc.)
            $table->string('carrier')->nullable(); // Opérateur mobile
            $table->string('merchant_subscriber_reference')->nullable(); // Référence marchand
            $table->string('site_id')->nullable(); // ID du site
            $table->string('product_id')->nullable(); // ID du produit
            $table->string('offer_id')->nullable(); // ID de l'offre
            $table->string('pricepoint_id')->nullable(); // ID du point de prix
            $table->string('payment_method')->nullable(); // Méthode de paiement
            $table->timestamp('transaction_date')->nullable(); // Date de la transaction
            $table->json('raw_data'); // Tous les paramètres reçus
            $table->boolean('signature_valid')->default(false); // Signature vérifiée ?
            $table->text('error_message')->nullable(); // Message d'erreur si échec
            $table->timestamps();
            
            // Index pour les recherches rapides
            $table->index(['provider', 'action']);
            $table->index(['subscriber_reference']);
            $table->index(['transaction_id']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webhook_logs');
    }
};
