<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Device;
use App\Models\Admin\DeviceCategory;
use App\Models\Admin\DeviceSensor;
use App\Models\Admin\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::orderBy('id', 'desc')->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Devices', 'url' => '']
        ];

        return view('admin.device.index', compact('devices', 'breadcrumbs'));
    }

    public function show_by_category($category_slug)
    {
        $products = Device::with('category')
                    ->whereRelation('category', 'slug', $category_slug)
                    ->orderBy('id', 'desc')->get();

        return view('admin.device.show_by_category', compact('products'));
    }

    public function create()
    {
        $categories = DeviceCategory::orderBy('id', 'desc')->get(['id', 'name']);
        $sensors    = Sensor::orderBy('name')->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Devices', 'url' => route('admin.device.manage')],
            ['name' => 'Generate Devices', 'url' => ''], // No URL for the last breadcrumb
        ];

        return view('admin.device.create', compact('categories', 'sensors', 'breadcrumbs'));
    }

    public function store(Request $request)
    {

        if (is_numeric($request->total_generate)) {
            for ($i = 1; $i <= $request->total_generate; $i++) {
                $category_id = $request->device_category;

                $last_generated_device = Device::orderBy('id', 'desc')->first();

                $device_id        = $last_generated_device->device_id ?? 0;
                $generated_id     = str_pad($device_id + 1, 10, "0", STR_PAD_LEFT);

                $device_id = DB::table('devices')->insertGetId([
                    'device_id'   => $generated_id,
                    'category_id' => $category_id,
                    'status'      => false
                ]);

                for ($j = 0; $j < count($request->sensor); $j++) {
                    DeviceSensor::create([
                        'device_id' => $device_id,
                        'sensor_id' => $request->sensor[$j]
                    ]);
                }
            }
        }

        return redirect(route('admin.device.manage'))->with('success', $request->total_generate.' devices is generated successful');

    }

    public function update (Request $request, $id) {
        Device::where('id', $id)->update([
            'status' => true
        ]);

        return redirect(route('admin.device.manage'))->with('success', 'Device data ativated successful');
    }


    public function destroy ($id) {
        Device::find($id)->delete();
        return redirect(route('admin.device.manage'))->with('success', 'Device data deleted successful');
    }
}