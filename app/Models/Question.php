<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'question_text', 'question_type'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function survey_QuestionOption()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }
}
