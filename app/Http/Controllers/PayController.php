<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Zarinpal;
use App\User;
use App\Exam;
use App\User_Exam;
class PayController extends Controller
{
    public function verify(Request $request)
    {
        session_start();
        if(Auth::check()){
            $user=Auth::user();
            $exam=Exam::find($_SESSION['exam_id']);
            $zarinpal = new Zarinpal('XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX');
            $zarinpal->enableSandbox();
            $authority = $_SESSION['Authority'];
            $verify=$zarinpal->verify('OK', $_SESSION['cost'], $authority);
            if($verify['Status'] == 'error'){
                return redirect('/paymentfail')->with('failer',$verify['error']);
            }
            if($verify['Status'] == 'success'){
                $user_exam =new User_Exam;

                $user_exam->exam_id=$exam->id;

                $user_exam->user_id=$user->id;

                $user_exam->pay=$_SESSION['cost'];

                $user_exam->RefID=$verify['RefID'];

                $user_exam->save();


                return redirect('/paymentsuccess')->with('verify',$verify['RefID']);
            }
        }else {

            return redirect('/login');


        }

    }
    public function order(Request $request){
//        session_start();
//        $exam=Exam::find($request->exam_id);
//        $cost=$exam->cost;
//        $exam_name=$exam->exam_name;
//        $zarinpal = new Zarinpal('XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX');
//        $zarinpal->enableSandbox();
//        // $zarinpal->isZarinGate(); // active zarinGate mode
//        $results = $zarinpal->request(
//            "http://exam.test/verify",          //required
//            $cost,                                    //required
//            $exam_name                            //required
//        );
//        if (isset($results['Authority'])) {
//            $_SESSION['cost']=$cost;
//            $_SESSION['exam_id']=$request->exam_id;
//            $_SESSION['Authority'] = $results['Authority'];
//            $zarinpal->redirect();
//        }

    }
}
