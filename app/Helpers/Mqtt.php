<?php

// app/Http/Controllers/MqttController.php
namespace App\Helpers;

use App\Services\MqttService;
use Illuminate\Http\Request;

class Mqtt extends Controller
{
    protected $mqtt;

    public function __construct(MqttService $mqtt)
    {
        $this->mqtt = $mqtt;
    }

    public function publish(Request $request)
    {
        $topic = $request->input('topic');
        $message = $request->input('message');
        $this->mqtt->publish($topic, $message);

        return response()->json(['status' => 'Message published']);
    }

    public function subscribe(Request $request)
    {
        $topic = $request->input('topic');
        $this->mqtt->subscribe($topic, function ($message) {
            // Handle incoming message
            echo $message;
        });

        return response()->json(['status' => 'Subscribed to topic']);
    }
}