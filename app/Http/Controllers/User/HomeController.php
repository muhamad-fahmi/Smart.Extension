<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\UserDevice;

class HomeController extends Controller
{
    public function dashboard () {
        $devices = UserDevice::where('user_id', auth()->user()->id)->get()->count();

        return view('user.dashboard', compact('devices'));
    }
}