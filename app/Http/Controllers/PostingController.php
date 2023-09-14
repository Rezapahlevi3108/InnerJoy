<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostingController extends Controller
{
    function index($id) {
        return view('posting.pages.posting');
    }
}
