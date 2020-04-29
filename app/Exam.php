<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    protected $fillable = [
        'exam_name', 'question_count', 'exam_time', 'start_date', 'end_date', 'desc', 'epicaddress', 'imagin_start', 'imagin_end', 'why_start', 'why_end',
        'describe_start', 'describe_end', 'cost', 'words_start', 'words_end', 'type_question'
        , 'option_count', 'category_id','author_id'
    ];

    public function question()
    {
        return $this->hasMany('App\Question')->orderBy('questions.id');
    }

    public function user_exam()
    {
        return $this->hasMany(User_Exam::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
