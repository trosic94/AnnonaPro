<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Import_ComputerLand_CATMNF',
        'App\Console\Commands\Import_ComputerLand_PROD',
        'App\Console\Commands\Import_ComputerLand_IMG',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import:CompLand_CATMNF')->daily()->at('11:00');
        $schedule->command('import:CompLand_PROD')->daily()->at('11:15');
        $schedule->command('import:CompLand_IMG')->daily()->at('11:45');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
