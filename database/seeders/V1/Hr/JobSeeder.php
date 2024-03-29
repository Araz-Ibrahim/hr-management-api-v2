<?php

namespace Database\Seeders\V1\Hr;

use App\Models\V1\Hr\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Job::count() > 0) {
            return;
        }

        // make a founder job
        Job::factory()->create([
            'title' => 'Founder',
        ]);

        Job::factory()->count(5)->create();
    }
}
