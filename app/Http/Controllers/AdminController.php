<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exam;
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
                return view('adminpanel.plain');
            } else {
                return redirect('/logout');
            }
        } else {

            return redirect('/login');
        }
    }

    public function add_exam()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('adminpanel.adminpanel',compact(['categories']));
    }

    public function delete_exam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect('/exams');
    }
}
