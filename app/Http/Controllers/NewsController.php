<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function submit(Request $req){
      if (Auth::check()) {
    	$user=Auth::user();
      	if ($user->roll==1) {
      		$news = News::create(['main_news'=>$req->news]);
      		return redirect('/adminpanel');
      	}else{
      		return redirect('/login');
      	}
      }else {
      	return redirect('/login');
      }



    }
    public function index(){
    	if(Auth::check()){
    		$user=Auth::user();
    		if ($user->roll==1) {
    	return view('adminpanel.news');
    		}else {
    			return redirect('login');
    		}
    } else {

     return redirect('/login');
    }
    }
        public function shownewstouser(){
    	if(Auth::check()){
    	$news=News::all();
    	return view('shownews',['news'=>$news]);
  
    }
}
}
