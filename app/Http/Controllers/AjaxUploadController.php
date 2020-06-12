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

        $question = Question::create(['exam_id' => $request->exam_id, 'question' => $request->question,
            'valid' => $request->valid, 'level' => $request->level]);

        if ($request->hasFile('select_file_0')) {
            $image0 = $request->file('select_file_0');
            $new_name0 = $request->exam_id . '.' . $question->id . '.' . $image0->getClientOriginalExtension();
            $image0->move(public_path('images.questionpic'), $new_name0);

            $question->save();
        }
        if (Exam::findOrFail($request->exam_id)->type_question == 0) {
            $question_id = $question->id;
            $option_count = $question->exam->option_count;
            for ($i = 0; $i < $option_count; $i++) {
                $option = Option::create(['question_id' => $question_id, 'option' => $request->option[$i]]);
                if (isset($request->select_file[$i])) {
                    $image = $request->select_file[$i];
                    $new_name = $request->exam_id . '.' . $question->id . '.' . $option->id . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images.optionpic'), $new_name);
                    $option->ohaspic = '1';
                    $option->opicaddress = $new_name;
                    $option->save();
                }

            }
            $option_count = $question->exam->option_count;

            $last_option_id = Option::all()->last()->id;
            $last_question = Question::all()->last();
            $last_question->valid = $last_option_id - ($option_count - $request->valid);
            $last_question->save();
        }
        return response()->json([
            ['success' => 'با موفقیت انجام شد']
        ]);
    }
}
