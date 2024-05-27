<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DeviceCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceCategoryController extends Controller
{
    public function index()
    {
        $categories = DeviceCategory::orderBy('id', 'desc')->get();

        return view('admin.device.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = DeviceCategory::orderBy('id', 'desc')->get(['id', 'name']);
        return view('admin.device.category.create', compact('categories'));
    }


    public function store(Request $request)
    {
        try {

            $filename = '';

            if ($request->file('image')) {
                $files = $request->file('image');
                $extention = $files->getClientOriginalExtension();
                date_default_timezone_set("Asia/Bangkok");
                if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' | $extention == 'webp') {
                    $filename = Str::slug($request->device_name, '-') . '-device.'.$extention;

                    if (file_exists(public_path() . '/assets/devices/images/' . $filename)) {
                        unlink(public_path() . '/assets/devices/images/' . $filename);
                    }

                    $files->move('assets/devices/images', $filename);
                }
            }

            DeviceCategory::create([
                'name'                  => $request->device_name,
                'price'                 => str_replace([',', '.'], '', $request->device_price),
                'stock'                 => $request->device_stock,
                'description'           => $request->device_description,
                'image'                 => $filename == '' ? null : $filename,
                'slug'                  => Str::slug($request->device_name, '-'),
            ]);

            return redirect(route('admin.device.category.manage'))->with('success', 'Device category created successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Device category name is exist, create with other name!');
        }

    }

    public function edit($id)
    {

        $device_category = DeviceCategory::find($id);

        return view('admin.device.category.edit', compact('device_category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $filename = '';

            if ($request->file('image')) {
                $files = $request->file('image');
                $extention = $files->getClientOriginalExtension();
                date_default_timezone_set("Asia/Bangkok");
                if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' | $extention == 'webp') {
                    $filename = Str::slug($request->device_name, '-') . '-device.'.$extention;

                    if (file_exists(public_path() . '/assets/devices/images/' . $filename)) {
                        unlink(public_path() . '/assets/devices/images/' . $filename);
                    }

                    $files->move('assets/devices/images', $filename);
                }
            }

            $device_category = DeviceCategory::where('id', $id)->first();

            DeviceCategory::where('id', $id)->update([
                'name'                  => $request->device_name,
                'price'                 => str_replace([',', '.'], '', $request->device_price),
                'stock'                 => $request->device_stock,
                'description'           => $request->device_description,
                'image'                 => $filename == '' ? $device_category->image : $filename,
                'slug'                  => Str::slug($request->device_name, '-'),
            ]);

            return redirect(route('admin.device.category.manage'))->with('success', 'Device category updated successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Update data is failed!');
        }
    }

    public function destroy($id)
    {
        try {

            $device_select = DeviceCategory::find($id);
            $image = $device_select->image;
            if ($image) {
                if (file_exists(public_path() . '/assets/devices/images/' . $image)) {
                    unlink(public_path() . '/assets/devices/images/' . $image);
                }
            }

            DeviceCategory::find($id)->delete();

            return redirect()->back()->with('success', 'Device category deleted successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Delete data is failed!');
        }
    }
}