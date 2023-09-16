<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    function login() {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
            return redirect()->back();
        } else {
            return view('auth.login');
        }
    }

    public function loginCheck(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        try {
            $find = User::where('email', $validation['email'])->first();
            $checkPass = $find ? Hash::check($validation['password'], $find->password) : false;
            if (!$find || !$checkPass) {
                return redirect()->route('login')->with('error', 'email / pass salah / tidak terdaftar');
            }
            if ($find->active == 0) {
                return redirect()->route('login')->with('error', 'Akun anda Terblokir');
            }
            Auth::login($find);
            if (Auth::user()->role == 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('user.dashboard'));
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    function register() {
        return view('auth.register');
    }

    public function regisStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

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
                'active' => true,
            ]);

            $user->UserDetail()->create();

            return redirect()->route('login')->with('success', 'Registrasi Berhasil');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function fromGoogle() {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('email', $user->email)->first();
            if($findUser) {
                Auth::login($findUser);
                return redirect()->intended(route('user.dashboard'));
            }else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->role = 'user';
                $newUser->active = true;
                $newUser->save();

                $newUser->UserDetail()->create();

                Auth::login($newUser);
                return redirect()->intended(route('user.dashboard'));
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
