<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'admin123',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        $this->call([
            DailyQuoteSeeder::class,
            PrayerSeeder::class,
            QuranVerseSeeder::class,
        ]);
    }
}
