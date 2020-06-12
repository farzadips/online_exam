<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exam;
use App\User_Exam;
use App\Student_Answer;
use Verta;
use DateTime;
use DateTimeZone;

class AnswerController extends Controller
{

    public function answersubmit(Request $req)
    {
        $user = Auth::user();
        $user_exam = $user->user_exam->where('exam_id', $req->exam_id)->first();
        $exam = $user_exam->exam;
        if (Student_Answer::where('user_exam_id', $user_exam->id)->first() == null) {
            for ($i = 0; $i < $exam->question_count; $i++) {
                $obj = 'question' . $i;
                if ($req->$obj != null) {
                    if ($exam->type_question == 0) {
                        Student_Answer::create(['user_exam_id' => $user_exam->id, 'option_id' => $req->$obj]);
                    } else {
                        Student_Answer::create(['user_exam_id' => $user_exam->id, 'answer' => $req->$obj]);
                    }
                }
            }
            return view('success');
        } else {
            return view('success');
        }
    }

    public function estimate(Request $req)
    {
//        dd($req);
        $user = Auth::user();
        $exam = Exam::find($req->exam_id);
        $end_date = $exam->end_date;
        $dt = new DateTime("now", new DateTimeZone('Asia/Tehran'));
        $dt = $dt->format('Y-m-d H:i:s');
        $dt = explode(" ", $dt);
        $date = $dt[0];
        $date = explode("-", $date);
        $jalali = Verta::getJalali($date[0], $date[1], $date[2]);
        $end_date = explode("-", $end_date);
//        if ($this->cmp_date($jalali,$end_date)) {
        $user_exam = $user->user_exam;
        $user_exam = $user_exam->where('exam_id', $req->exam_id)->first();
        $user_answers_obj = Student_Answer::where('user_exam_id', $user_exam->id)->get();
        foreach ($user_answers_obj as $user_answer_obj) {
            if ($exam->type_question == 0) {
                $answers[] = $user_answer_obj->option_id;
            } else {
                $answers[] = $user_answer_obj->answer;
            }
        }
        $question_count = $exam->question_count;
        $questions = $exam->question;
        foreach ($questions as $question) {
            $valid[] = $question->valid;
            if ($exam->type_question == 0) {
                $option[] = $question->option;
            }
        }
        sort($valid);

        $truecounter = 0;
        $falsecounter = 0;

        for ($i = 0; $i < sizeof($answers); $i++) {
            if (in_array($answers[$i], $valid)) {
                $truecounter = $truecounter + 1;
            } else {
                $falsecounter = $falsecounter + 1;
            }
        }
        $percent = ((($truecounter * 4) - $falsecounter) / ($question_count * 4)) * 100;
        $user_exam->percent = $percent;
        $user_exam->save();
        if ($exam->type_question == 0) {
            if ($exam->hoosh == 1) {
                return view('score', ['exam' => $exam, 'trueanswer' => $truecounter, 'falseanswer' => $falsecounter, 'percent' => $percent, 'count' => $question_count,
                    'questions' => $questions, 'options' => $option, 'answers' => $answers, 'imagin_percent' => $imaginpercent, 'why_percent' => $whypercent, 'describe_percent' => $describepercent, 'words_percent' => $wordspercent]);
            } else {
                return view('score', ['exam' => $exam, 'trueanswer' => $truecounter, 'falseanswer' => $falsecounter, 'percent' => $percent, 'count' => $question_count,
                    'questions' => $questions, 'options' => $option, 'answers' => $answers]);
            }
        } else {

            if ($exam->hoosh == 1) {
                return view('score', ['exam' => $exam, 'trueanswer' => $truecounter, 'falseanswer' => $falsecounter, 'percent' => $percent, 'count' => $question_count,
                    'questions' => $questions, 'valids' => $valid, 'answers' => $answers, 'imagin_percent' => $imaginpercent, 'why_percent' => $whypercent, 'describe_percent' => $describepercent, 'words_percent' => $wordspercent]);
            } else {
                return view('score', ['exam' => $exam, 'trueanswer' => $truecounter, 'falseanswer' => $falsecounter, 'percent' => $percent, 'count' => $question_count,
                    'questions' => $questions, 'valids' => $valid, 'answers' => $answers]);
            }
        }
//    }else{
//     return redirect('/results')->with('exam_not_finished','نتایج آزمون پس از پایان روز آزمون قابل  مشاهده خواهند بود.');
//    }


    }

    public function showinvolvedexams()
    {
        $user = Auth::user();
        $user_exams = $user->user_exam;
        foreach ($user_exams as $user_exam) {
            if (Student_Answer::where('user_exam_id', '=', $user_exam->id)->exists()) {
                $exams[] = User_Exam::where('id', $user_exam->id)->get();
            }
        }
        if (isset($exams)) {


            for ($i = 0; $i < sizeof($exams); $i++) {
                $result[] = Exam::where('id', $exams[$i][0]->exam_id)->get();
            }

        }
        if (isset($result)) {

            return view('examresult', ['result' => $result]);
        } else {
            return view('examresult');
        }

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

