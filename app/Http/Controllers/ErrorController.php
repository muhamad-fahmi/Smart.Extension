<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error_permission () {
        return view('other.access_denied');
    }
}