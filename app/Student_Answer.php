<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Answer extends Model
{
	protected $fillable = [
        'option_id','user_exam_id','answer'
    ];
    public function option(){

      return $this->belongsTo('App\Option');
    }
     public function user_exam(){

      return $this->belongsTo('App\User_Exam');
    }
}
