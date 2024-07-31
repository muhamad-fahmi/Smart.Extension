<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DeviceCategory;
use App\Models\Admin\Sensor;
use App\Models\Admin\SensorParameter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceSensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::orderBy('id', 'desc')->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Sensors', 'url' => ''],
        ];

        return view('admin.device.sensor.index', compact('sensors', 'breadcrumbs'));
    }

    public function create()
    {
        $categories = DeviceCategory::orderBy('id', 'desc')->get(['id', 'name']);

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Sensors', 'url' => route('admin.device.sensor.manage')],
            ['name' => 'Create Sensor', 'url' => ''], // No URL for the last breadcrumb
        ];

        return view('admin.device.sensor.create', compact('categories', 'breadcrumbs'));
    }


    public function store(Request $request)
    {
        try {

            // dd($request->all());

            $check = Sensor::where('name', $request->sensor_name)->first();

            if (!empty($check)) {
                return redirect()->back()->with('error', 'Device sensor name is exist, create with other name!');
            } else {

                $filename = '';

                if ($request->file('image')) {
                    $files = $request->file('image');
                    $extention = $files->getClientOriginalExtension();
                    date_default_timezone_set("Asia/Bangkok");
                    if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' | $extention == 'webp') {
                        $filename = Str::slug($request->sensor_name, '-') . '-sensor.'.$extention;

                        if (file_exists(public_path() . '/assets/sensor/images/' . $filename)) {
                            unlink(public_path() . '/assets/sensor/images/' . $filename);
                        }

                        $files->move('assets/sensor/images', $filename);
                    }
                }

                $id_sensor = DB::table('sensors')->insertGetId([
                    'name'                  => $request->sensor_name,
                    'image'                 => $filename == '' ? null : $filename,
                    'description'           => $request->sensor_description,
                    'code'                  => $request->sensor_code,
                ]);

                for ($i = 0; $i < count($request->param_key); $i++) {
                    SensorParameter::create([
                        'sensor_id'     => $id_sensor,
                        'key'           => $request->param_key[$i],
                        'type'          => $request->param_type[$i]
                    ]);
                }

                return redirect(route('admin.device.sensor.manage'))->with('success', 'Device sensor created successful');
            }


        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Device sensor name is exist, create with other name!');
        }

    }

    public function edit($id)
    {

        $sensor = Sensor::find($id);

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Sensors', 'url' => route('admin.device.sensor.manage')],
            ['name' => 'Edit Sensor', 'url' => ''], // No URL for the last breadcrumb
        ];

        return view('admin.device.sensor.edit', compact('sensor', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        try {
            $sensor = Sensor::where('id', $id)->first();

            if (!empty($sensor)) {

                $filename = '';

                if ($request->file('image')) {
                    $files = $request->file('image');
                    $extention = $files->getClientOriginalExtension();
                    date_default_timezone_set("Asia/Bangkok");
                    if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' | $extention == 'webp') {
                        $filename = Str::slug($request->sensor_name, '-') . '-sensor.'.$extention;

                        if (file_exists(public_path() . '/assets/sensor/images/' . $filename)) {
                            unlink(public_path() . '/assets/sensor/images/' . $filename);
                        }

                        $files->move('assets/sensor/images', $filename);
                    }
                }

                Sensor::where('id', $id)->update([
                    'name'                  => $request->sensor_name,
                    'image'                 => $filename == '' ? $sensor->image : $filename,
                    'description'           => $request->sensor_description,
                    'code'                  => $request->sensor_code,
                ]);

                SensorParameter::where('sensor_id', $id)->delete();

                for ($i = 0; $i < count($request->param_key); $i++) {
                    SensorParameter::create([
                        'sensor_id'     => $id,
                        'key'           => $request->param_key[$i],
                        'type'          => $request->param_type[$i]
                    ]);
                }

                return redirect(route('admin.device.sensor.manage'))->with('success', 'Device sensor updated successful');

            } else {
                return redirect()->back()->with('error', 'Device not found!');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Update data is failed!');
        }
    }

    public function destroy($id)
    {
        try {

            $sensor = Sensor::find($id);
            $image = $sensor->image;
            if ($image) {
                if (file_exists(public_path() . '/assets/sensor/images/' . $image)) {
                    unlink(public_path() . '/assets/sensor/images/' . $image);
                }
            }

            Sensor::find($id)->delete();

            return redirect()->back()->with('success', 'Device sensor deleted successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Delete data is failed!');
        }
    }
}