<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur de test principal
        User::create([
            'login' => 'test_user',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'msisdn' => '+33612345678',
            'subscription_id' => 'SUB_TEST_001',
            'subscribed' => true,
            'credit_ia' => 500,
            'last_rebill_at' => now(),
        ]);

        // Créer quelques utilisateurs supplémentaires
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'login' => 'user_' . $i,
                'email' => 'user' . $i . '@example.com', // Ajout d'un email pour chaque utilisateur
                'password' => Hash::make('password'),
                'msisdn' => '+3361234567' . $i,
                'subscription_id' => 'SUB_TEST_00' . ($i + 1),
                'subscribed' => $i <= 3, // 3 actifs, 2 inactifs
                'credit_ia' => rand(0, 1000),
                'last_rebill_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}