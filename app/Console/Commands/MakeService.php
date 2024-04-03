<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {path?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->argument('path') ?? '';
        $serviceClassName = ucwords($name);
        $serviceNamespace = 'App\\Services';
        $serviceDirectory = app_path("Services/$path");
        $serviceFilePath = "$serviceDirectory/{$serviceClassName}.php";

        // Ensure the services directory exists
        if (!File::isDirectory($serviceDirectory)) {
            File::makeDirectory($serviceDirectory, 0755, true);
        }

        // Check if service already exists
        if (File::exists($serviceFilePath)) {
            $this->error("Service {$serviceClassName} already exists!");
            return;
        }

        // Get stub content
        $stubPath = resource_path('stubs/service.stub');
        $stub = File::get($stubPath);

        // Replace placeholders
        $stub = str_replace('{{namespace}}', $serviceNamespace . '\\' . str_replace('/', '\\', $path), $stub);
        $stub = str_replace('{{className}}', $serviceClassName, $stub);

        // Write service file
        File::put($serviceFilePath, $stub);

        $this->info("Service {$serviceClassName} created successfully!");
    }
}
