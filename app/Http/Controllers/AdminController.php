<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Posting;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        $dataAdmin = User::where('role', 'admin')->where('active', 1)->count();
        $dataAdminNonActive = User::where('role', 'admin')->where('active', 0)->count();
        $dataUser = User::where('role', 'user')->where('active', 1)->count();
        $dataUserNonActive = User::where('role', 'user')->where('active', 0)->count();
        $dataPosting = Posting::where('status', 1)->count();
        $dataPostingNonActive = Posting::where('status', 0)->count();
        return view('admin.pages.dashboard',compact('user', 'dataAdmin', 'dataAdminNonActive', 'dataUser', 'dataUserNonActive', 'dataPosting', 'dataPostingNonActive'));
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

    function indexAdmin() {
        $data = User::all();
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.admin',compact('data','user'));
    }

    function getAdmin() {
        $loggedInUserId = Auth::id();
        $data = User::where('role', 'admin')->where('id', '!=', $loggedInUserId)->get();
        return response()->json(['data' => $data]);
    }

    function storeAdmin(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return "Email sudah terdaftar";
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'role' => 'admin',
                'active' =>  $request->active,
            ]);

            $user->UserDetail()->create();

            return response()->json(['status'=>'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function showAdmin(string $id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json(['data' => $user]);
    }

    function updateAdmin(Request $request, string $id) {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'active' =>  $request->active,
            ]);

            $data = User::where('id', $user->id)->get();

            return response()->json(['status'=>'Data Berhasil Diupdate']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function destroyAdmin(string $id) {
        try {
            $user = User::findOrFail($id);
            $data = $user->UserDetail()->delete();
            $data = $user->delete();
            return response()->json(['status'=>'Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function indexUser() {
        $data = User::all();
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.user',compact('data','user'));
    }

    function getUser() {
        $loggedInUserId = Auth::id();
        $data = User::where('role', 'user')->where('id', '!=', $loggedInUserId)->get();
        return response()->json(['data' => $data]);
    }

    function storeUser(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return "Email sudah terdaftar";
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'role' => 'user',
                'active' =>  $request->active,
            ]);

            $user->UserDetail()->create();

            return response()->json(['status'=>'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function showUser(string $id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json(['data' => $user]);
    }

    function updateUser(Request $request, string $id) {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'active' =>  $request->active,
            ]);

            $data = User::where('id', $user->id)->get();

            return response()->json(['status'=>'Data Berhasil Diupdate']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function destroyUser(string $id) {
        try {
            $user = User::findOrFail($id);
            $data = $user->UserDetail()->delete();
            $data = $user->delete();
            return response()->json(['status'=>'Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function indexPosting() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.posting',compact('user'));
    }

    function getPosting() {
        $data = Posting::with('user')->get();
        // foreach ($data as $item) {
        //     $item->title = Str::limit($item->title, 30);
        //     $item->content = Str::limit($item->content, 160);
        // }
        return response()->json(['data' => $data]);
    }

    function detailPosting($id) {
        $data = Posting::find($id);
        return response()->json(['data' => $data]);
    }

    function blockPosting(string $id) {
        try {
            $posting = Posting::find($id);

            if (!$posting) {
                return response()->json(['status'=>'Posting not found']);
            }

            if ($posting->status == true) {
                $posting->update(['status' => '0']);
                $statusMessage = 'Berhasil Dinonaktifkan';
            } else {
                $posting->update(['status' => '1']);
                $statusMessage = 'Berhasil Diaktifkan';
            }
    
            return response()->json(['status' => $statusMessage]);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function destroyPosting(string $id) {
        try {
            $posting = Posting::findOrFail($id);
            $data = $posting->delete();
            return response()->json(['status'=>'Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }
}
