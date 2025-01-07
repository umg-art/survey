<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'gender'];

    public function survey_Question()
    {
        return $this->hasMany(Question::class, 'survey_id');
    }
}


