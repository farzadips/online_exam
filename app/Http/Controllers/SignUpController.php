<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'identity_code' => 'required|numeric',
//            'name' => 'required|max:30|alpha',
//            'lastname' => 'required|max:30|alpha',
//            'email' => 'required|email|max:60',
//            'password' => 'required|numeric',
//
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/signup')
//                ->withErrors($validator)
//                ->withInput();
//        } else {
            $user = User::create([
                'phone' => $request->password, 'identity_code' => $request->identity_code, 'name' => $request->name,
                'lastname' => $request->lastname, 'email' => $request->email, 'roll' => $request->role,
                'password' => Hash::make($request->password)
            ]);
//            Auth::login($user);
            return redirect('/login');
        }
//    }
}
