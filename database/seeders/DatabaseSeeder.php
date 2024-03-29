<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\V1\Hr\EmployeeJobSeeder;
use Database\Seeders\V1\Hr\EmployeeSeeder;
use Database\Seeders\V1\Hr\JobSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Call the seeders
        $this->call([
            JobSeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
