<?php

namespace App\Console;

use App\Jobs\ProcessEmailCampaign;
use App\Jobs\ProcessSmsCampaign;
use App\Models\EmailCampaign;
use App\Models\SmsCampaign;
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
        // start the queue worker, if its not running
        if (!$this->osProcessIsRunning('queue:work')) {
            $schedule->command('queue:work')->everyMinute();
        }

        $smsCampaigns = SmsCampaign::where('status', 'Pending')->whereDate('schedule_time', date('Y-m-d'))->get();
        foreach($smsCampaigns as $smsCampaign) {
            $schedule->job(new ProcessSmsCampaign($smsCampaign))->when(function() use ($smsCampaign) {
                $now = date('Y-m-d H:i:s');
                if (strtotime($smsCampaign->schedule_time) < strtotime($now)) {
                    $smsCampaign->update(['status' => 'Processing']);
                    return true;
                }
            });
        }

        $emailCampaigns = EmailCampaign::where('status', 'Pending')->whereDate('schedule_time', date('Y-m-d'))->get();
        foreach($emailCampaigns as $emailCampaign) {
            $schedule->job(new ProcessEmailCampaign($emailCampaign))->when(function() use ($emailCampaign) {
                $now = date('Y-m-d H:i:s');
                if (strtotime($emailCampaign->schedule_time) < strtotime($now)) {
                    $emailCampaign->update(['status' => 'Processing']);
                    return true;
                }
            });
        }
    }

    /**
     * Undocumented function
     *
     * @param string $needle
     * @return bool
     */
    protected function osProcessIsRunning($needle)
    {
        // get process status. the "-ww"-option is important to get the full output!
        exec('ps aux -ww', $process_status);

        // search $needle in process status
        $result = array_filter($process_status, function($var) use ($needle) {
            return strpos($var, $needle);
        });

        // if the result is not empty, the needle exists in running processes
        if (!empty($result)) {
            return true;
        }
        return false;
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
