<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wisata;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Wisata::create([
            'name' => 'Pantai Kuta',
            'description' => 'Pantai Kuta adalah salah satu pantai terkenal di Bali, Indonesia. Dikenal dengan pasir putihnya yang lembut dan ombak yang cocok untuk berselancar.',
            'location' => 'Kuta Bali',
        ]);
    }
}
