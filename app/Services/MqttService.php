<?php
// app/Services/MqttService.php
namespace App\Services;

use PhpMqtt\Client\Facades\MQTT;

class MqttService
{
    public function publish($topic, $message)
    {
        $mqtt = MQTT::connection();
        $mqtt->publish($topic, $message);
    }

    public function subscribe($topic, $callback)
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe($topic, $callback);
        $mqtt->loop(true);
    }
}