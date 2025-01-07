<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function survey_Question()
    {
        return $this->hasMany(Question::class, 'survey_id');
    }
}
