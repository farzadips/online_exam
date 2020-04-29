<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exam;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->roll == "1") {
                $exams = Exam::all();
                $examcount = sizeof($exams);
                $myexam =Exam::with('author')->where('author_id',$user->id)->get();
                $myexamcount = sizeof($myexam);
                $categorycount = sizeof(Category::with('childrenRecursive')
                    ->where('parent_id', null)
                    ->get());
                $newscount = sizeof(News::all());
                return view('adminpanel.dashboard',compact(['user','examcount','myexamcount','categorycount','newscount']));
            } else {
                return redirect('/logout');
            }
        } else {

            return redirect('/login');
        }
    }


}
