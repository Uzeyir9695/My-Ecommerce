<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

         \App\Models\User::factory()->count(3)->create();

        $this->call([
            HouseholdSeeder::class,
            ElectronicSeeder::class,
            KitchenAppliancesSeeder::class,
            MenClothingSeeder::class,
            WomenClothingSeeder::class,
            StoreTableSeeder::class,
            ProductTableSeeder::class,
        ]);
    }
}
