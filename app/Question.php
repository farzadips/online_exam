<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'exam_id', 'question','valid','level'
    ];
    public function exam(){
    	return $this->belongsTo('App\Exam');
    }
    public function option(){
    	return $this->hasMany('App\Option')->orderBy('options.id');
    }
}
