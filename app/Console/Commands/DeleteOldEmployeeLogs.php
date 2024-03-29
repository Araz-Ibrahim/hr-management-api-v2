<?php

namespace App\Console\Commands;

use App\Models\V1\Hr\EmployeeLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldEmployeeLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:delete-old-employee-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete logs older than 1 month.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Calculate the date 1 month ago
        $oneMonthAgo = Carbon::now()->subMonth();

        // Delete logs older than 1 month
        $deletedLogsCount = EmployeeLog::where('created_at', '<', $oneMonthAgo)->delete();

        $this->info("Deleted $deletedLogsCount old employee logs.");
    }
}
