<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Exam;
use App\Option;
use App\User_Exam;
use App\Student_Answer;
use App\Question;
use Verta;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function submit(Request $request)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->roll == "1") {

                $validator = Validator::make($request->all(), [
                    'exam_name' => 'required|string|max:60',
                    'question_count' => 'required|numeric',
                    'exam_time' => 'required|numeric',
                    'start_date' => 'required|string|max:12',
                    'end_date' => 'required|string||max:12',
                    'desc' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect('/adminpanel')
                        ->withErrors($validator)
                        ->withInput();
                } else {

                    $exam = Exam::create(['imagin_start' => $request->imagin_start, 'imagin_end' => $request->imagin_end, 'exam_name' => $request->exam_name, 'question_count' => $request->question_count,
                        'exam_time' => $request->exam_time, 'cost' => $request->cost, 'type_question' => $request->type_question,
                        'start_date' => $request->start_date, 'end_date' => $request->end_date,
                        'desc' => $request->desc, 'epicaddress' => 'nothing', 'words_start' => $request->words_start,
                        'words_end' => $request->words_end, 'option_count' => $request->option_count,
                        'category_id' => $request->category_id, 'author_id' => $user->id]);
                    $image = $request->file('image');
                    $new_name = $exam->exam_name . '.' . $image->getClientOriginalExtension();
                    $exam->epicaddress = $new_name;
                    $exam->save();

                    $image->move(public_path('images.exampic'), $new_name);

                    return view('adminpanel.options.definequestions', ['exam_name' => $exam->exam_name, 'exam_time' => $exam->exam_time,
                        'question_count' => $exam->question_count, 'exam_id' => $exam->id, 'type_question' => $exam->type_question
                        , 'option_count' => $exam->option_count
                    ]);

                }
            } else {
                return redirect('/logout');
            }
        } else {
            return redirect('/login');
        }

    }

    public function showexams()
    {
        if (Auth::check()) {
            $auth_user = Auth::user();
            if ($auth_user->roll == "0") {

                $user_exams = $auth_user->user_exam;
                $user_exams_model = $user_exams->map(function ($ex) {
                    return Exam::find($ex->exam_id);
                });
                $exams_that_not_signed_up = Exam::whereNotIn('id', $user_exams->map(function ($ex) {
                    return $ex->exam_id;
                }))->get();

                return view('exams', ['exam_signed_up' => $user_exams_model,
                    'exam_not_signed_up' => $exams_that_not_signed_up
                ]);
            } elseif ($auth_user->roll == "1") {
                $exams = Exam::all();
                $users = User::all();
                return view('adminpanel.exams.showexams', compact(['exams', 'users']));
            }
        } else {
            return redirect('/login');
        }
    }

    public function showmyexams()
    {
        $user = Auth::user();
        if ($user->roll = "1") {
            $users = User::all();
            $exams = Exam::all();
            return view('adminpanel.exams.showmyexams', compact(['user', 'users', 'exams']));
        } else {
            return redirect('/logout');
        }
    }

    public function entrycheck(Request $request)
    {
        if (Auth::check()) {
            $exam = Exam::where('id', $request->exam_id)->first();
            $start_date = $exam->start_date;
            $end_date = $exam->end_date;
            $dt = new DateTime("now", new DateTimeZone('Asia/Tehran'));
            $dt = $dt->format('Y-m-d H:i:s');
            $dt = explode(" ", $dt);
            $date = $dt[0];
            $time = $dt[1];
            $date = explode("-", $date);
            $time = explode(":", $time);
            $jalali = Verta::getJalali($date[0], $date[1], $date[2]);
            $start_date = explode("-", $start_date);
            $end_date = explode("-", $end_date);
            $user = Auth::user();
            if (($this->cmp_date($jalali, $start_date) && $this->cmp_date($end_date, $jalali)) || $user->id == 30) {
                $user_obj = User::where('id', $user->id)->first();
                $user_exam = $user_obj->user_exam->where('exam_id', $exam->id)->first();
                if ($user_exam != null) {
                    if (Student_Answer::where('user_exam_id', $user_exam->id)->first() == null) {
                        $questions = Question::where('exam_id', $exam->id)->orderBy('id', 'ASC')->get();

                        foreach ($questions as $question) {
                            $option[] = $question->option;
                        }
                        return view('exam', ['questions' => $questions, 'options' => $option, 'exam' => $exam]);
                    } else {
                        return redirect('/exams')->with('once_error', 'شما یک بار در این آزمون شرکت کرده اید');
                    }

                } else {
                    return redirect('/exams')->with('signup_error', 'شما در این آزمون ثبته نام نکرده اید');

                }


            } else {
                return redirect('/exams')->with('time_error', 'زمان ورود مجاز نیست');
            }

        } else {
            return redirect('/login');
        }


    }


    public function add_exam()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        return view('adminpanel.exams.design', compact(['categories']));
    }

    public function edit_exam($id)
    {
        $exam = Exam::findOrFail($id);
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        return view("adminpanel.exams.edit", compact(['exam', 'categories']));
    }

    public function submit_edit(Request $request, $id)
    {

        $exam = Exam::FindOrFail($id);
        $exam->imagin_start = $request->imagin_start;
        $exam->imagin_end = $request->imagin_end;
        $exam->exam_name = $request->exam_name;
        $exam->question_count = $request->question_count;
        $exam->exam_time = $request->exam_time;
        $exam->cost = $request->cost;
        $exam->type_question = $request->type_question;
        $exam->start_date = $request->start_date;
        $exam->end_date = $request->end_date;
        $exam->desc = $request->desc;

        $exam->words_start = $request->words_start;
        $exam->words_end = $request->words_end;
        $exam->option_count = $request->option_count;
        $exam->category_id = $request->category_id;

        $image = $request->file('image');
        $new_name = $exam->exam_name . '.' . $image->getClientOriginalExtension();
        $exam->epicaddress = $new_name;
        $exam->save();

        $image->move(public_path('images.exampic'), $new_name);

        $questions = Question::with('exam')
            ->where('exam_id', $exam->id)->get();

        $counarray [] = [];
        for ($i = 0; $i < sizeof($questions); $i++) {
            $counarray[$i] = $questions[$i]->id;
        }

        $options = Option::with('question')
            ->whereIn('question_id', $counarray)->get();


        return view('adminpanel.options.editquestions', compact(['exam', 'questions', 'options', 'counarray']));
    }

    public function submit_question_edit(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->valid = $request->valid;
        $question->level = $request->level;
        $question->question = $request->question;
        $question->save();
        $options = Option::with('question')->where('question_id', $id)->get();

        for ($i = 0; $i < sizeof($request->option); $i++) {
            $op_id = $options[$i]->id;
            $op = Option::findOrFail($op_id);
            $op->option = $request->option[$i];
            $op->save();
        }
//        ------------------------------------------
        $exam = Exam::findOrFail($question->exam_id);
        $questions = Question::with('exam')
            ->where('exam_id', $exam->id)->get();

        $counarray [] = [];
        for ($i = 0; $i < sizeof($questions); $i++) {
            $counarray[$i] = $questions[$i]->id;
        }

        $options = Option::with('question')
            ->whereIn('question_id', $counarray)->get();
//
        return view('adminpanel.options.editquestions', compact(['exam', 'questions', 'options', 'counarray']));

    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $category = Category::findOrFail($id);


        $category->save();
        return redirect('/adminpanel/categories');
    }


    public function delete_exam($id)
    {
        $exam = Exam::findOrFail($id);
//        return $exam;
        $exam->delete();
        return redirect('/myexams');
    }


    private function cmp_date($date1, $date2)
    {
        if ($date1[0] > $date2[0])
            return true;
        elseif ($date1[0] < $date2[0])
            return false;
        elseif ($date1[1] > $date2[1])
            return true;
        elseif ($date1[1] < $date2[1])
            return false;
        elseif ($date1[2] > $date2[2])
            return true;
        elseif ($date1[2] < $date2[2])
            return false;
        else
            return true; // When two dates are equal.
    }
}

