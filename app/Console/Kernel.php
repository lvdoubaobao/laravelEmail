<?php

namespace App\Console;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function Clue\StreamFilter\fun;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

      /*  $schedule->command('huihua')->everyTwoHours()->withoutOverlapping();*/
     /*   $schedule->command('blackList')->everyTwoHours()->withoutOverlapping();*/
      /*  $schedule->command('email:corn')->everyMinute()->withoutOverlapping();*/
       // $schedule->command('cron:name 21')->everyMinute()->withoutOverlapping();
        Administrator::chunk(3,function($admins)use ($schedule){
            foreach ($admins as $admin){
                /**
                 * @var Administrator $admin
                 */
                $schedule->command('phone:corn '.$admin->id)->everyMinute()->withoutOverlapping()->runInBackground();
            }
        });
      // $schedule->command('import:data')->everyMinute()->withoutOverlapping();
     /*   $schedule->command('user:send 1')->everyTwoHours()->withoutOverlapping();
        $schedule->command('user:send 2')->everyTwoHours()->withoutOverlapping();
        $schedule->command('user:send 0')->everyTwoHours()->withoutOverlapping();*/

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
