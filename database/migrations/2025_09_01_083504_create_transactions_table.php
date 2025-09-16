<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable(); // Lié à un utilisateur si créé
            $table->string('provider'); // 'mobiyo', 'allopass', etc.
            $table->string('action'); // Type d'action
            $table->string('transaction_id')->unique(); // ID unique de la transaction
            $table->string('subscriber_reference')->nullable(); // Référence abonné
            $table->string('status'); // Statut de la transaction
            $table->string('status_description')->nullable(); // Description du statut
            $table->decimal('amount', 10, 2); // Montant
            $table->string('currency', 3); // Devise
            $table->string('customer_country', 2)->nullable(); // Pays client
            $table->timestamp('transaction_date'); // Date de la transaction
            $table->json('metadata')->nullable(); // Données additionnelles
            $table->timestamps();
            
            // Index
            $table->index(['provider', 'action']);
            $table->index(['subscriber_reference']);
            $table->index(['user_id']);
            $table->index(['transaction_date']);
            
            // Relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
