<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Exam;
use App\User_Exam;
use App\Student_Answer;

class UserController extends Controller
{
	public function index() 
	{
          
		 if(Auth::check()){
            return view('userpanel');
	                      }
		else 
		{
           redirect('/login');
		}

}
	public function setting(){
      if (Auth::check()) {
      	$user=Auth::user();
      	return view('usersetting',['user'=>$user]);
      }else{
      return redirect('/logout');
  }
	}
	public function changeuserinfo(Request $req){

          $validator = Validator::make($req->all(), [
            'identity_code' => 'required|numeric',
            'name' => 'required|max:30|alpha',
            'lastname' => 'required|max:30|alpha',
            'email'=>'required|email|max:60',
            'password'=>'nullable|numeric',
            'repeat_password'=>'nullable|numeric',
            'phone'=>'required|numeric',]);

        if ($validator->fails()) {
					            return redirect('/setting')
					                        ->withErrors($validator)
					                        ->withInput();
        } else {
           if (Auth::check()) {
           	if ($req->password!=null) {
           		
           	   if ($req->password==$req->repeat_password) {
             	}else{
              return redirect('/setting')->with('password_not_match','رمز های عبور وارد شده مشابه نیستند');
           	}
           	}
		      	$user=Auth::user();
		      	$user->name=$req->name;
		      	$user->lastname=$req->lastname;
		      	$user->phone=$req->phone;

		      		
		      	$user->password= Hash::make($req->password);
		      
		      	$user->email=$req->email;
		      	$user->identity_code=$req->identity_code;
		      	$user->save();
		      	return redirect('/setting');
      }else{
      return redirect('/logout');
  }
	}
}
public function estimate(Request $req){
	    $users=User::all();
	    $exam=Exam::where('id',4)->first();
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
    	     }
    	foreach ($users as $user) {
            $imagintruecounter=0;
            $imaginfalsecounter=0;
            $describetruecounter=0;
            $describefalsecounter=0;
            $whytruecounter=0;
            $whyfalsecounter=0;
            $wordstruecounter=0;
            $wordsfalsecounter=0;
        $user_exam=$user->user_exam;
    	$user_exam=$user_exam->where('exam_id',4)->first();
    	if($user_exam !=null){
    
    	$user_answers_obj=Student_Answer::where('user_exam_id',$user_exam->id)->get();
    	if($user_answers_obj != null){
    	 $this_exam_users[]=$user;
    	$answers=[];
    	
    	foreach ($user_answers_obj as $user_answer_obj) {
    		$answers[]=$user_answer_obj->option_id;
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
        $imaginpercent[$user->id]=((($imagintruecounter*4)-$imaginfalsecounter)/(($exam->imagin_end-$exam->imagin_start+1)*4))*100;
        $describepercent[$user->id]=((($describetruecounter*4)-$describefalsecounter)/(($exam->describe_end-$exam->describe_start+1)*4))*100;
        $whypercent[$user->id]=((($whytruecounter*4)-$whyfalsecounter)/(($exam->why_end-$exam->why_start+1)*4))*100;
         $wordspercent[$user->id]=((($wordstruecounter*4)-$wordsfalsecounter)/(($exam->words_end-$exam->words_start+1)*4))*100;
    	$truecounter=0;
    	$falsecounter=0;
    	for ($i=0; $i <sizeof($answers); $i++) { 
    		if (in_array($answers[$i], $valid)) {
    			$truecounter=$truecounter+1;
    		}else {
    			$falsecounter=$falsecounter+1;
    		}
    	}
    	$percent[$user->id]=((($truecounter*4)-$falsecounter)/($question_count*4))*100;
    	unset($answers);
    	}else {
    	    continue;
    	}
    	}
    	else {
    	    continue;
    	}
    }
    return view('resulttable',['imaginpercent'=>$imaginpercent,'wordspercent'=>$wordspercent,'whypercent'=>$whypercent,'describepercent'=>$describepercent,'percent'=>$percent,'userss'=>$this_exam_users]);
}
}
