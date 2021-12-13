<?php

namespace App\Console;

use App\Console\Commands\DemoCron;
use App\Models\CronLogs;
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
        Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

//        $schedule->command('gj')->everyMinute();
//        $schedule->call(function (){
//            $cl = new CronLogs;
//            $cl->log = 'cron';
//            $cl->type = -1;
//            $cl->save();
//        })->everyMinute();
        $schedule->command('demo:cron')->everyMinute();
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
