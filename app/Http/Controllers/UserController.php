<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index() {
        $data = Posting::where('user_id', Auth::user()->id)->get();
        return view('user.pages.dashboard',compact('data'));
    }

    function profile() {
        return view('user.pages.profile');
    }

    function post() {
        return view('user.pages.post');
    }

    function storePost(Request $request) {
        try {
            $posting = new Posting();
            $newFileName = 'innerjoy'.time().".".$request->file('file')->extension();
            $posting->user_id = Auth::user()->id;
            $posting->cover = $newFileName;
            $posting->title = $request->title;
            $posting->content = $request->content;
            $request->file('file')->move(public_path('images'), $newFileName);
            $posting->save();
            return redirect()->route('user.dashboard')->with('success','Berhasil Posting');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error',$th->getMessage());
        }
    }

    function editPost($id) {
        $data = Posting::find($id);
        return view('user.pages.editPost',compact('data'));
    }

    function storeEditPost(Request $request) {
        try {
            $posting = Posting::find(Auth::user()->id);
            $posting->title = $request->title;
            $posting->content = $request->content;
            $newFileName = 'innerjoy'.time().".".$request->file('file')->extension();
            $posting->cover = $newFileName;
            $request->file('file')->move(public_path('images'), $newFileName);
            $posting->save();
            return redirect()->route('user.dashboard')->with('success','Berhasil Ubah Posting');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error',$th->getMessage());
        }
    }

    function deletePost($id) {
        try {
            $posting = Posting::find($id);
            $posting->delete();
            return redirect()->route('user.dashboard')->with('success','Berhasil Hapus Posting');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error',$th->getMessage());
        }
       
    }
}
