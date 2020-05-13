<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Response;
use PDF;
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
            $user = Auth::user();
            if ($user->roll == "0") {


                $exams= Exam::all();

                return view('exams', compact(['exams','user']));
            } elseif ($user->roll == "1") {
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

    public function show_students(Request $request,$id)
    {
        $exam = Exam::findOrFail($id);
        $user_exams = $exam->user_exam;

        return view('adminpanel.exams.show_students',compact(['exam','user_exams']));
    }

    public function show_questions($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = Question::with('exam')->where('exam_id', $exam->id)->get();
        $counarray [] = [];
        for ($i = 0; $i < sizeof($questions); $i++) {
            $counarray[$i] = $questions[$i]->id;
        }

        $options = Option::with('question')
            ->whereIn('question_id', $counarray)->get();
        return view('adminpanel.exams.show_questions', compact(['exam', 'questions', 'options']));
    }

    public function entrycheck(Request $request)
    {
        if (Auth::check()) {
            $user_exam = new User_Exam();
            $user_exam->exam_id = $request->exam_id;
            $user_exam->user_id = $request->user_id;
            $user_exam->save();


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
            $user_obj = User::where('id', $user->id)->first();
            $questions = Question::with('exam')
                ->where('exam_id', $exam->id)->get();

            foreach ($questions as $question) {
                $options[] = $question->option;
            }

            return view('exam', ['questions' => $questions, 'options' => $options, 'exam' => $exam]);
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


        return view('adminpanel.options.editquestions', compact(['exam', 'questions', 'options']));
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

    /**
     * Force client agent to download questions of given exam as a PDF file.
     *
     * @param  int $id
     * @return Response
     */
    public function downloadPdf($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = Question::with('exam')->where('exam_id', $exam->id)->get();
        $countArray = [];
        foreach ($questions as $question) {
            array_push($countArray, $question->id);
        }
        $options = Option::with('question')->whereIn('question_id', $countArray)->get();
        return PDF::loadView('adminpanel.exams.show_questions_download', compact('exam', 'questions', 'options'), [], 'UTF-8')
            ->download("questions_for_exam_$id.pdf");
    }
}
