<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index() {
        return view('user.pages.dashboard');
    }

    function profile() {
        return view('user.pages.profile');
    }

    function post() {
        return view('user.pages.post');
    }
}
