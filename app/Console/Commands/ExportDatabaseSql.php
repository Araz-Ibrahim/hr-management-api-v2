<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDatabaseSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-sql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export the database to a SQL file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = 'database_backup_' . date('YmdHis') . '.sql';

        $this->info("Exporting database to $fileName...");

        $passwordOption = !empty(env('DB_PASSWORD')) ? "--password=" . env('DB_PASSWORD') : '';

        // Dump database to SQL file
        $command = "mysqldump --user=" . env('DB_USERNAME') . " $passwordOption " . env('DB_DATABASE') . " > " . storage_path('app/' . $fileName);
        $status = shell_exec($command);

        if ($status === null) {
            $this->info("Database exported successfully to $fileName.");
        } else {
            $this->error("Failed to export database.");
        }
    }
}
