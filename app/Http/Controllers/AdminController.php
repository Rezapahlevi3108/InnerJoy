<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.dashboard',compact('user'));
    }
    function profile() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.profile',compact('user'));
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
}
