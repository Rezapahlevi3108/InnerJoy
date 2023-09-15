<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posting;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index() {
        $data = Posting::where('user_id', 1)->get();
        return view('user.pages.dashboard',compact('data'));
    }

    function profile() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('user.pages.profile',compact('user'));
    }

    function editProfile(Request $request) {
        try {
            $user = User::where('id',Auth::user()->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
            $userDetail->phone = $request->phone;
            $userDetail->address = $request->address;
            if($request->hasFile('file')){
                $userDetail ->profile_photo = 'innerjoy'.time().'.'.$request->file->extension();
                $request->file->move(public_path('profile'), 'innerjoy'.time().'.'.$request->file->extension());
            }
            $userDetail->save();
            
            return response()->json(['status' => 'Berhasil Ubah Profil']);
        } catch (\Throwable $th) {
            return response()->json(['status' => $th->getMessage()]);
        }
    }

    function post() {
        return view('user.pages.post');
    }

    function storePost(Request $request) {
        try {
            $posting = new Posting();
            $newFileName = 'innerjoy'.time().".".$request->file('file')->extension();
            $posting->user_id = 1;
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
            $posting = Posting::find($request->id);
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
