<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->nullable()->change();
            $table->string('currency', 3)->nullable()->change();
            $table->string('customer_country', 2)->nullable()->change();
            $table->timestamp('transaction_date')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->nullable(false)->change();
            $table->string('currency', 3)->nullable(false)->change();
            $table->string('customer_country', 2)->nullable(false)->change();
            $table->timestamp('transaction_date')->nullable(false)->change();
        });
    }
};
