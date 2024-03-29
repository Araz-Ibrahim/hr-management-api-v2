<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all log files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the path to the log directory
        $logPath = storage_path('logs');

        // Get all files in the log directory
        $logFiles = File::glob("$logPath/*.log");

        // Iterate over each log file and delete it
        foreach ($logFiles as $file) {
            File::delete($file);
            $this->info("Deleted log file: $file");
        }

        $this->info('All log files have been deleted.');
    }
}
