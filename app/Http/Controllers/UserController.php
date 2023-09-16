<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posting;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function index() {
        $data = Posting::where('user_id', Auth::user()->id)->get();
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
            $userDetail->bio = $request->bio;
            if($request->hasFile('file')){
                File::delete('profile/'.$userDetail->profile_photo);
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
            $posting->user_id = Auth::user()->id;
            $posting->title = $request->title;
            $posting->content = $request->content;
            if($request->hasFile('file')){
                $newFileName = 'innerjoy'.time().".".$request->file('file')->extension();
                $posting->cover = $newFileName;
                $request->file('file')->move(public_path('images'), $newFileName);
            }else{
                $posting->cover = 'lost_home.jpg';
            }
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
            if($request->hasFile('file')){
                $newFileName = 'innerjoy'.time().".".$request->file('file')->extension();
                $posting->cover = $newFileName;
                $request->file('file')->move(public_path('images'), $newFileName);
            }else{
                $posting->cover = $posting->cover;
            }
            $posting->save();
            return redirect()->route('user.dashboard')->with('success','Berhasil Ubah Posting');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error',$th->getMessage());
        }
    }

    function deletePost($id) {
        try {
            $posting = Posting::find($id);
            File::delete('images/'.$posting->cover);
            $posting->delete();
            return redirect()->route('user.dashboard')->with('success','Berhasil Hapus Posting');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error',$th->getMessage());
        }
       
    }

    function fetchData($kategori=1,$visibilitas=true) {
        try {
            if($kategori == 1){
                $data = Posting::where('status',$visibilitas)->orderBy('created_at','desc')->get();
            }else{
                $data = Posting::where('status',$visibilitas)->orderBy('like','desc')->get();
            }
            $result = [
                'data' => $data,
                'message' => 'Sucees Get Data'
            ];
            return response()->json($result,200);
        } catch (\Throwable $th) {
            $result = [
                'data' => null,
                'message' => 'Fail cause '.$th->getMessage()
            ];
            return response()->json($result,500);
        }
    }

    function searchData($kategori=1,$visibilitas=true,$query) {
        try {
            if($kategori == 1){
                $data = Posting::where('status',$visibilitas)->where('title','like','%'.$query.'%')->orderBy('created_at','desc')->get();
            }else{
                $data = Posting::where('status',$visibilitas)->where('title','like','%'.$query.'%')->orderBy('like','desc')->get();
            }
            $result = [
                'data' => $data,
                'message' => 'Sucees Get Data'
            ];
            return response()->json($result,200);
        } catch (\Throwable $th) {
            $result = [
                'data' => null,
                'message' => 'Fail cause '.$th->getMessage()
            ];
            return response()->json($result,500);
        }
    }
}
