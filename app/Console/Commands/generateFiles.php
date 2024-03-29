<?php

/*
 * license MIT
 * author: (github.com/araz-ibrahim)
 */

/* Example Usage:
 * $ php artisan make:generate-files "Language" "Home"
 * $ php artisan make:generate-files "Language" ""
 * $ php artisan make:generate-files "Language" "Home" --fac-seed
 * $ php artisan make:generate-files "Language" "Home" --policy
 * $ php artisan make:generate-files "Language" "Home" --fac-seed --policy
 * $ php artisan make:generate-files "Language" "Home" --fac-seed
 * $ php artisan make:generate-files "Language" "v1/Blog" --fac-seed
*/

namespace App\Console\Commands;

use Illuminate\Console\Command;

class generateFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generate-files {name : The name of the model.} {path : The path to generate files.} {--fac-seed : Indicates whether to generate factory and seeder files or not.} {--policy : Indicates whether to generate policy files or not.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate files for a Laravel model.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modelName = ucfirst($this->argument('name'));
        $path = $this->argument('path');
        $modelPath = "/{$path}/{$modelName}";
        $controllerPath = "{$modelPath}Controller";
        $repositoryPath = "{$modelPath}Repository";
        $requestPath = "{$modelPath}Request";
        $resourcePath = "{$modelPath}Resource";
        $factoryPath = "{$modelPath}Factory";
        $seederPath = "{$modelPath}Seeder";
        $migrationName = "create_".strtolower($modelName)."_table";
        $policyPath = "{$modelPath}Policy";
        $makeFactoryAndSeeder = $this->option('fac-seed') === true;
        $makePolicy = $this->option('policy') === true;


        // Generate migration file
        $this->call('make:migration', [
            'name' => $migrationName,
            '--create' => true,
            '--path' => "/database/migrations/{$path}/"
        ]);

        // Generate model class file
        $this->call('make:model', [
            'name' => $modelPath
        ]);

        // Generate resource class file
        $this->call('make:resource', [
            'name' => $resourcePath
        ]);

        // Generate form request class file
        $this->call('make:request', [
            'name' => $requestPath
        ]);

        // Generate controller class file
        $this->call('make:controller', [
            'name' => $controllerPath,
            '--api' => true,
            '--model' => $modelPath,
            '--resource' => $resourcePath
        ]);

        // Generate repository class file
        $this->call('make:repository', [
            'name' => $repositoryPath
        ]);

        // Generate factory and seeder class files
        if($makeFactoryAndSeeder) {
            // Generate factory class file
            $this->call('make:factory', [
                'name' => $factoryPath
            ]);

            // Generate seeder class file
            $this->call('make:seeder', [
                'name' => $seederPath
            ]);
        }

        // Generate policy class file
        if ($makePolicy) {
            $this->call('make:policy', [
                'name' => $policyPath,
                '--model' => "App\Models{$modelPath}"
            ]);
        }

        return Command::SUCCESS;
    }
}
