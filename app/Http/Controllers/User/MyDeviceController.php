<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Device;
use App\Models\Admin\DeviceCategory;
use App\Models\Admin\Sensor;
use App\Models\User\UserDevice;
use App\Models\User\UserDeviceSchedule;
use App\Services\MqttService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpMqtt\Client\Facades\MQTT;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


use PhpMqtt\Client\Examples\Shared\SimpleLogger;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\MqttClient;
use Psr\Log\LogLevel;

// use Salman\Mqtt\Facades\Mqtt;


class MyDeviceController extends Controller
{

    protected $mqtt;

    public function __construct(MqttService $mqtt)
    {
        $this->mqtt = $mqtt;
    }
    public function index()
    {
        $my_devices = UserDevice::orderBy('id', 'desc')->get();
        $get        = $this;

        return view('user.device.index', compact('my_devices', 'get'));
    }

    public function show_device ($device_id) {
        $device = Device::where('device_id', $device_id)->first();

        if (!empty($device)) {
            return view('user.device.show', compact('device'));
        } else {
            abort(404);
        }

    }

    public function create()
    {
        return view('user.device.create');
    }


    public function store(Request $request)
    {
        try {
            $device = Device::where('device_id', $request->validate_id)->first();

            $status = 0;

            if (!empty($device)) {
                if ($device->status == true) {
                    if (!empty($device->user)) {
                        $status = 0;
                    } else  {
                        $status = 1;
                    }
                } else {
                    $status = 0;
                }
            } else {
                $status = 0;
            }


            // dd($request->all());

            if ($status ==  1) {
                $id_user_device = DB::table('user_devices')->insertGetId([
                    'user_id'   => auth()->user()->id,
                    'device_id' => $request->validate_id,
                    'name'      => $request->device_name
                ]);

                if (count($request->scheduled_time) > 0) {
                    for ($i = 0; $i < count($request->scheduled_time); $i++) {
                        UserDeviceSchedule::create([
                            'user_device_id' => $id_user_device,
                            'action'         => !empty($request->scheduled_action[$i]) ? ($request->scheduled_action[$i] == 'on' ? "ON" : null) : "OFF",
                            'scheduled_time' => str_replace(['.', ','], ':', $request->scheduled_time[$i])
                        ]);
                    }
                }

                return redirect(route('customer.device.manage'))->with('success', 'User device created successful');
            } else {
                return redirect(route('customer.device.manage'))->with('error', 'ID device tidak valid');
            }


        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Device name is exist, create with other name!');
        }

    }

    public function validate_device($device_id)
    {

        $device = Device::where('device_id', $device_id)->first();

        $status = 0;
        $message = '';

        if (!empty($device)) {
            if ($device->status == true) {
                if (!empty($device->user)) {
                    $status = 0;
                    $message = 'ID anda tidak valid atau sudah dipakai oleh pengguna lain !';
                } else  {
                    $status = 1;
                    $message = 'ID anda valid';
                }
            } else {
                $status = 0;
                $message = 'ID perangkat belum aktif';
            }
        } else {
            $status = 0;
            $message = 'ID anda tidak valid atau tidak ditemukan';
        }

        return response()->json([
            'status'    => $status,
            'msg'       => $message
        ]);
    }

    public function edit($id)
    {

        $device_category = DeviceCategory::find($id);

        return view('user.device.edit', compact('device_category'));
    }

    public function update(Request $request, $id)
    {
        try {
            UserDevice::where('id', $id)->update([
                'name'      => $request->device_name
            ]);


            UserDeviceSchedule::where('user_device_id', $id)->delete();

            for ($i = 0; $i < count($request->scheduled_time); $i++) {
                UserDeviceSchedule::create([
                    'user_device_id' => $id,
                    'action'         => !empty($request->scheduled_action[$i]) ? ($request->scheduled_action[$i] == 'on' ? "ON" : null) : "OFF",
                    'scheduled_time' => str_replace(['.', ','], ':', $request->scheduled_time[$i])
                ]);
            }


            return redirect(route('customer.device.manage'))->with('success', 'Device name updated successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Update data is failed!');
        }
    }

    public function destroy($id)
    {
        try {
            UserDevice::find($id)->delete();

            return redirect()->back()->with('success', 'Device deleted successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Delete data is failed!');
        }
    }

    public function get_sensor_data($device_id, $sensor_id) {

        $sensor = Sensor::where('id', $sensor_id)->first();

        $mqtt = MQTT::connection();

        $sensor_name = strtolower(str_replace(' ', '', $sensor->name));

        foreach ($sensor->params as $item) {
            $mqtt->subscribe($device_id.'/sensor/'.$sensor_name.'/'.$item->key, function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
            }, 1);
            $mqtt->loop(true);
        }

    }

    public function pub($device_id, $switch) {

        ini_set('max_execution_time', 300);
        // $logger = new SimpleLogger(LogLevel::INFO);



        $message = "";

        if ($switch === 'true') {
            $message = "ON";
        } else {
            $message = "OFF";
        }

        $topic = $device_id . '/relay';

        try {


            $command = '/opt/homebrew/bin/mosquitto_pub -h '.env('MQTT_HOST').' -p '.env('MQTT_PORT').' -u '.env('MQTT_AUTH_USERNAME').' -P '.env('MQTT_AUTH_PASSWORD').' -t "'.$topic.'" -m "'.$message.'"';
            $process = Process::fromShellCommandline($command);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                return response()->json([
                    'status' => 'error',
                    'error' => $process->getErrorOutput()
                ], 500);
            }

            return response()->json([
                'status' => 'success',
                'output' => $process->getOutput()
            ]);


        } catch (\Excetion $e) {
            return response()->json([
                'status' => false
            ]);
        }


    }

    public function sub($device_id) {

        ini_set('max_execution_time', 300);

        $topic = $device_id . '/relay';

        try {


            $command = '/opt/homebrew/bin/mosquitto_pub -h '.env('MQTT_HOST').' -p '.env('MQTT_PORT').' -u '.env('MQTT_AUTH_USERNAME').' -P '.env('MQTT_AUTH_PASSWORD').' -t "'.$topic.'" -m "'.$message.'"';
            $process = Process::fromShellCommandline($command);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                return response()->json([
                    'status' => 'error',
                    'error' => $process->getErrorOutput()
                ], 500);
            }

            return response()->json([
                'status' => 'success',
                'output' => $process->getOutput()
            ]);


        } catch (\Excetion $e) {
            return response()->json([
                'status' => false
            ]);
        }


    }
}