<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\FetchGoogleSheetData::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule the fetch:google-sheets command every 15 minutes
        $schedule->command('fetch:google-sheets')->everyFifteenMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
