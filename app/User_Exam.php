<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Exam extends Model
{
    protected $fillable = [
        'exam_id', 'user_id', 'pay',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function exam(){
    	return $this->belongsTo('App\Exam');
    }
    public function user_answer(){
    	return $this->hasMany('App\Student_Answer');
    }
}
