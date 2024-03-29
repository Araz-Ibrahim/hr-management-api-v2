<?php

namespace App\Console\Commands;

use App\Models\V1\Hr\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:export-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all employees to a JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = 'employees_' . date('YmdHis') . '.json';

        $this->info("Exporting employees...");

        $employees = Employee::all();

        $jsonContent = $employees->toJson(JSON_PRETTY_PRINT);

        Storage::put($fileName, $jsonContent);

        $this->info("Employees exported successfully to storage/app/$fileName.");
    }
}
