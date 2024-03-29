<?php

namespace Database\Seeders\V1\Hr;

use App\Models\V1\Hr\Employee;
use App\Models\V1\Hr\Job;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initiate the Seeder only for the first time
        if (Employee::count() > 0) {
            return;
        }

        //create the founder that is manager_id = null
        $founder = Employee::factory()->create([
            'name' => 'Founder',
            'manager_id' => null,
            'job_id' => Job::where('title', 'Founder')->first()->id ?? Job::factory()->create([
                'title' => 'Founder',
            ])->id,
            'salary' => 100000,
        ]);

        // get all jobs except the founder
        $jobs = Job::where('title', '!=', 'Founder')->get();

        //create 5 managers
        $managers = Employee::factory()->count(5)->create([
            'manager_id' => $founder->id,
            'job_id' => $jobs->pluck('id')->shuffle()->first(),
        ]);

        //create 25 employees
        for ($i = 0; $i < 25; $i++) {
            Employee::factory()->create([
                'manager_id' => $managers->pluck('id')->shuffle()->first(),
                'job_id' => $jobs->pluck('id')->shuffle()->first(),
            ]);
        }
    }
}
