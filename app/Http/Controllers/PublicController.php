<?php

namespace App\Http\Controllers;

use App\Models\Admin\News;
use App\Models\Admin\NewsCategory;
use App\Models\Admin\TermRule;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index () {
        return view('index');
    }


}