<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class PublishMQTTMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic, $message;

    /**
     * Create a new job instance.
     */
    public function __construct($topic, $message)
    {
        $this->topic    = $topic;
        $this->message  = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Starting MQTT publish for topic: {$this->topic} with message: {$this->message}");


        $command = '/opt/homebrew/bin/mosquitto_pub -h '.env('MQTT_HOST').' -p '.env('MQTT_PORT').' -u '.env('MQTT_AUTH_USERNAME').' -P '.env('MQTT_AUTH_PASSWORD').' -t "'.$this->topic.'" -m "'.$this->message.'"';

        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            Log::error('MQTT publish failed: ' . $process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        \Log::info('Message published successfully: ' . $process->getOutput());
    }
}