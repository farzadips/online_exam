<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Question;
use App\Option;

class AjaxUploadController extends Controller
{

    function action(Request $request)
    {
        $question = Question::create(['exam_id'=>$request->exam_id,'question'=>$request->question,
            'valid'=>$request->valid,'level'=>$request->level]);

                  if ($request->hasFile('select_file_0')){
                  $image0 = $request->file('select_file_0');
                  $new_name0 = $request->exam_id . '.' .$question->id.'.'. $image0->getClientOriginalExtension();
                  $image0->move(public_path('images.questionpic'), $new_name0);

                  $question->save();
               }
          $question_id=$question->id;
           for ($i=0; $i <2 ; $i++) {
          $option = Option::create(['question_id'=>$question_id,'option'=>$request->option[$i]]);
                  if (isset($request->select_file[$i])){
                  $image = $request->select_file[$i];
                  $new_name = $request->exam_id . '.' .$question->id.'.'.$option->id.'.'. $image->getClientOriginalExtension();
                  $image->move(public_path('images.optionpic'), $new_name);
                  $option->ohaspic='1';
                  $option->opicaddress=$new_name;
                  $option->save();
               }
//            if ($i==$request->valid-1) {
//              $question->update(['valid' =>$option->id ]);
//            }
        }

      return response()->json([
       ['success'=>'با موفقیت انجام شد']
      ]);
     }
}