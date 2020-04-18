<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class AdminController extends Controller
{
   public function index(){
   	if (Auth::check()) {
    $user=Auth::user();
    if ($user->roll=="1") {
    	return view('adminpanel.adminpanel');
    }
    else{
    return redirect ('/logout');
    }
}else{

	return redirect ('/login');
     }
}
}
