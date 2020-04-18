<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

	public $timestamps = false;
	protected $fillable = [
        'question_id', 'option', 'ohaspic','opicaddress',
    ];
    public function question(){
    	return $this->belongsTo('App\Question');
    }
    public function student_answer(){
    	return $this->hasMany('App\Student_Answer');
    }
}
