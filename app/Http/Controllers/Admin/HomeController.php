<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Device;
use App\Models\Admin\DeviceCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {

        $users = User::where('role_id', 2)->get()->count();
        $devices = Device::where('status', 1)->get()->count();
        $categories = DeviceCategory::get()->count();

        return view('admin.index', compact('users', 'devices', 'categories'));
    }

    public function get_rejected() {
        $user_invoices = UserInvoices::where('status', false)->where('is_rejected', true)->orderBy('id', 'desc')->get();
        return view('admin.user-invoice.rejected', compact('user_invoices'));
    }
}