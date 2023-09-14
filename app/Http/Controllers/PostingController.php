<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    function index($id) {
        $addSee = Posting::find($id);
        $addSee->see++;
        $addSee->save();
        $data = Posting::where('id',$id)->first();
        return view('posting.pages.posting',compact('data'));
    }

    function beranda() {
        return view('posting.pages.beranda');
    }
}
