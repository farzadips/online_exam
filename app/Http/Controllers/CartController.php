<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Exam;
use App\Option;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $question = \App\Question::findOrFail($id);
        $oldcart = \Illuminate\Support\Facades\Session::has('cart') ? \Illuminate\Support\Facades\Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->add($question, $question->id);
        $request->session()->put('cart', $cart);
//        dd($request->session()->get('cart'));
        return back();
    }

    public function showCart(Request $request)
    {
//        dd(\Illuminate\Support\Facades\Session::get('cart'));
        $questions = \App\Question::all();
        $options = \App\Option::all();
        $i = 0;

        return view('adminpanel.cart.index', compact(['options', 'questions', 'i']));
    }

    public function saveCart(Request $request)
    {
        $option_count = sizeof($request->option) / sizeof($request->question);
        $user = Auth::user();
        $cart = \Illuminate\Support\Facades\Session::get('cart')->questions;
        $exam = Exam::create(['exam_name' => $request->exam_name, 'question_count' => sizeof($request->question),
            'exam_time' => sizeof($request->question) * 10, 'show_to_others' => 1, 'cost' => 100, 'type_question' => 1,
            'start_date' => $request->start_date, 'end_date' => $request->end_date,
            'desc' => ' تهیه شده از سوال اساتید دیگر', 'epicaddress' => 'nothing',
            'option_count' => $option_count,
            'author_id' => $user->id]);
        $exam->save();
        foreach (\Illuminate\Support\Facades\Session::get('cart')->questions as $session_item) {
            $question = Question::create(['exam_id' => $exam->id, 'question' => $session_item['question']->question,
                'valid' => $session_item['question']->valid, 'level' => $session_item['question']->level]);
            $question->save();

            foreach ($session_item['question']->option as $option) {
                $option = Option::create(['question_id' => $question->id, 'option' => $option->option]);
                $option->save();

            }
        }
        return redirect('exams');
    }
}
