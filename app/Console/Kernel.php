<?php

namespace App\Console;

use App\Jobs\PublishMQTTMessage;
use App\Models\User\UserDeviceSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedules = UserDeviceSchedule::all();

        foreach ($schedules as $userSchedule) {
            $deviceId = $userSchedule->user_device->device->device_id;
            $action = $userSchedule->action;
            $scheduledTime = $userSchedule->scheduled_time;
            Log::info("Scheduling job for device ID: $deviceId with action: $action at $scheduledTime");

            $schedule->job(new PublishMQTTMessage("$deviceId/relay", $action))
                ->dailyAt($scheduledTime);
        }

        $schedule->call(function () {
            Log::info('Scheduler is running');
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}