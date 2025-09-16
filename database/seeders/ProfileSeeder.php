<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Replace existing profiles to ensure local image paths are used
        Schema::disableForeignKeyConstraints();
        Profile::truncate();
        Schema::enableForeignKeyConstraints();

        $profiles = [
            [
                'name' => 'Emma',
                'description' => 'Passionnée de voyages et de photographie',
                'order_index' => 1,
                'photos' => [
                    '/images/profiles/emma/picture1.jpg',
                    '/images/profiles/emma/picture2.jpg',
                    '/images/profiles/emma/picture3.jpg',
                ],
            ],
            [
                'name' => 'Sophie',
                'description' => 'Amatrice de cuisine et de bons vins',
                'order_index' => 2,
                'photos' => [
                    '/images/profiles/sophie/picture1.jpg',
                    '/images/profiles/sophie/picture2.jpg',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 3,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 4,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 5,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 6,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 7,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 8,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 9,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
            [
                'name' => 'Clara',
                'description' => 'Sportive et aventurière',
                'order_index' => 10,
                'photos' => [
                    'https://via.placeholder.com/400x600/FFA07A/FFFFFF?text=Clara+1',
                    'https://via.placeholder.com/400x600/98D8C8/FFFFFF?text=Clara+2',
                    'https://via.placeholder.com/400x600/F7DC6F/FFFFFF?text=Clara+3',
                ],
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}