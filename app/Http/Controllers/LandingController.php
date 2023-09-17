<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    function index() {
        $data = Posting::where('status', 1)->take(8)->orderBy('see','desc')->get();
        return view('landing.index',compact('data'));
    }
}
