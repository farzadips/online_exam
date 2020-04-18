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

    public function answersubmit(Request $req){
    	 $user=Auth::user();
         $user_exam=$user->user_exam->where('exam_id', $req->exam_id)->first();
         $exam=$user_exam->exam;
         if(Student_Answer::where('user_exam_id', $user_exam->id)->first()==null){
         for ($i=0; $i <$exam->question_count ; $i++) { 
         	$obj='question'.$i;
         	if ($req->$obj != null) {
         		Student_Answer::create(['user_exam_id'=>$user_exam->id,'option_id'=>$req->$obj]);
         		
         	}
         }
         return view('success');
         }else{
            return view('success');
         }  
    }
    public function estimate(Request $req){
    	$user=Auth::user();
       	$exam=Exam::find($req->exam_id);
        $end_date=$exam->end_date;
        $dt = new DateTime("now", new DateTimeZone('Asia/Tehran'));
        $dt= $dt->format('Y-m-d H:i:s');
        $dt=explode(" ",$dt);
        $date=$dt[0];
        $date=explode("-",$date);
        $jalali=Verta::getJalali($date[0],$date[1],$date[2]);
        $end_date=explode("-",$end_date);
        if ($this->cmp_date($jalali,$end_date)) {
    	$user_exam=$user->user_exam;
    	$user_exam=$user_exam->where('exam_id',$req->exam_id)->first();
    	$user_answers_obj=Student_Answer::where('user_exam_id',$user_exam->id)->get();
    	foreach ($user_answers_obj as $user_answer_obj) {
    		$answers[]=$user_answer_obj->option_id;
    	}
       	$question_count=$exam->question_count;
    	$questions=$exam->question;
    	foreach ($questions as $question ) {
    		$valid[]=$question->valid;
            $option[]= $question->option;
    	}
        sort($valid);
        if ($exam->hoosh==1) {
            $imagintruecounter=0;
            $imaginfalsecounter=0;
            $describetruecounter=0;
            $describefalsecounter=0;
            $whytruecounter=0;
            $whyfalsecounter=0;
            $wordstruecounter=0;
            $wordsfalsecounter=0;
        for ($j=$exam->imagin_start-1; $j<$exam->imagin_end; $j++) { 
           $imagin_valid[]=$valid[$j];
                    }   
        for ($t=$exam->words_start-1; $t<$exam->words_end; $t++) { 
           $words_valid[]=$valid[$t];
                    }  
         for ($k=$exam->why_start-1; $k<$exam->why_end; $k++) { 
           $why_valid[]=$valid[$k];
                    }  
         for ($s=$exam->describe_start-1; $s<$exam->describe_end; $s++) { 
           $describe_valid[]=$valid[$s];
                    }  

                for ($i=0; $i <sizeof($imagin_valid); $i++) {
                 if (in_array($imagin_valid[$i], $answers)) {
                $imagintruecounter=$imagintruecounter+1;
                }else {
                $imaginfalsecounter=$imaginfalsecounter+1;
                }
                 }
                     for ($i=0; $i <sizeof($why_valid); $i++) {
                 if (in_array($why_valid[$i], $answers)) {
                $whytruecounter=$whytruecounter+1;
                }else {
                $whyfalsecounter=$whyfalsecounter+1;
                }
                 }
                     for ($i=0; $i <sizeof($describe_valid); $i++) {
                 if (in_array($describe_valid[$i], $answers)) {
                $describetruecounter=$describetruecounter+1;
                }else {
                $describefalsecounter=$describefalsecounter+1;
                }
                 }
                     for ($i=0; $i <sizeof($words_valid); $i++) {
                 if (in_array($words_valid[$i], $answers)) {
                $wordstruecounter=$wordstruecounter+1;
                }else {
                $wordsfalsecounter=$wordsfalsecounter+1;
                }
                 }
                
     
        $imaginpercent=((($imagintruecounter*4)-$imaginfalsecounter)/(($exam->imagin_end-$exam->imagin_start+1)*4))*100;
        $describepercent=((($describetruecounter*4)-$describefalsecounter)/(($exam->describe_end-$exam->describe_start+1)*4))*100;
        $whypercent=((($whytruecounter*4)-$whyfalsecounter)/(($exam->why_end-$exam->why_start+1)*4))*100;
         $wordspercent=((($wordstruecounter*4)-$wordsfalsecounter)/(($exam->words_end-$exam->words_start+1)*4))*100;

        }
    	$truecounter=0;
    	$falsecounter=0;

    	for ($i=0; $i <sizeof($answers); $i++) { 
    		if (in_array($answers[$i], $valid)) {
    			$truecounter=$truecounter+1;
    		}else {
    			$falsecounter=$falsecounter+1;
    		}
    	}
    	$percent=((($truecounter*4)-$falsecounter)/($question_count*4))*100;
        if ($exam->hoosh==1) {
        	return view('score',['trueanswer'=>$truecounter,'falseanswer'=>$falsecounter,'percent'=>$percent,'count'=>$question_count,
            'questions'=>$questions,'options'=>$option,'answers'=>$answers,'imagin_percent'=>$imaginpercent,'why_percent'=>$whypercent,'describe_percent'=>$describepercent,'words_percent'=>$wordspercent]);
        }else {
            return view('score',['trueanswer'=>$truecounter,'falseanswer'=>$falsecounter,'percent'=>$percent,'count'=>$question_count,
            'questions'=>$questions,'options'=>$option,'answers'=>$answers]);
        }
    }else{
     return redirect('/results')->with('exam_not_finished','نتایج آزمون پس از پایان روز آزمون قابل  مشاهده خواهند بود.');
    }
    
   
}
    public function showinvolvedexams(){
    	$user=Auth::user();
    	$user_exams=$user->user_exam;
    	foreach ($user_exams as $user_exam) {
    		if (Student_Answer::where('user_exam_id', '=', $user_exam->id)->exists()) {
    			$exams[]=User_Exam::where('id',$user_exam->id)->get();
    		}
    	}
    	if (isset($exams)) {
    		
    	
    	for ($i=0; $i < sizeof($exams) ; $i++) { 
    		$result[]=Exam::where('id',$exams[$i][0]->exam_id)->get();
    	}

    }
    if (isset($result)) {
    	
    	return view('examresult',['result'=>$result]);
    }
    else{
    	return view('examresult');
    }
    	
}
  private function cmp_date($date1,$date2){
        if($date1[0] > $date2[0])
          return true;
        elseif($date1[0] < $date2[0])
          return false;
        elseif($date1[1] > $date2[1])
          return true;
        elseif($date1[1] < $date2[1])
          return false;
        elseif($date1[2] > $date2[2])
          return true;
        elseif($date1[2] < $date2[2])
          return false;
        else
          return true; // When two dates are equal.
  }
}

