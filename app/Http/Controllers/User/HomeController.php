<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\UserDevice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard () {
        $devices = UserDevice::where('user_id', auth()->user()->id)->get()->count();

        return view('user.dashboard', compact('devices'));
    }

    function calculatePercentage($number, $total)
    {
        if ($total == 0) {
            return 0;
        }

        $percentage = ($number / $total) * 100;
        return $percentage;
    }
}