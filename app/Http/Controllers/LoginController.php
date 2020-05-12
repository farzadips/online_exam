<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/userpanel');
        } else {
            return view('auth.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function resetpassword(Request $request)
    {
        $newpass = rand();
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $myerror = 'ایمیل وجود ندارد';
            return view('auth.resetpass', ['emailerror' => $myerror]);
        } else {
            $newhashpass = Hash::make($newpass);
            $user->password = $newhashpass;
            $user->save();
            Mail::to($request->email)->send(new ResetPassword($newpass));
            return redirect('/login');
        }
    }

    public function reset_index()
    {
        return view('auth.resetpass');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('identity_code', 'password');
        $validator = Validator::make($request->all(), [


            'identity_code' => 'required|numeric',
            'password' => 'required|max:60',

        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        } elseif (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roll == "0") {
                return redirect('/userpanel');
            } elseif ($user->roll == "1") {
                return redirect('/adminpanel');
            } else {
                return redirect('/logout');
            }
        } else {
            $error = 'نام کاربری و رمز عبور را چک کنید.';
            return view('auth.login', ['error' => $error]);
        }
    }

}
