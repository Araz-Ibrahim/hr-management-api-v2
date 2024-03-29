<?php

namespace App\Console\Commands;

use App\Models\V1\Hr\Employee;
use Illuminate\Console\Command;

class InsertEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:insert {count : The number of employees to insert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert employee data based on a given number with progress bar';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');

        $this->info("Inserting $count employees...");

        $bar = $this->output->createProgressBar($count);

        // Temporarily disable model events for Employee model (cuz we have observers for this model)
        Employee::withoutEvents(function () use ($count, $bar) {
            for ($i = 0; $i < $count; $i++) {
                Employee::create([
                    'name' => 'Employee ' . ($i + 1),
                    'email' => 'employee' . ($i + 1) . '@example.com',
                    'manager_id' => 1, // Set the manager ID as needed
                    'job_id' => 2, // Set the job ID as needed
                    'salary' => 50000, // Set the salary as needed
                ]);

                $bar->advance();
            }
        });

        $bar->finish();

        $this->info("\nInsertion complete!");
    }
}
