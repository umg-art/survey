<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Answer;
use Illuminate\Http\Request;

class SurveyReportController extends Controller
{
    public function index($surveyId)
    {
        $survey = Survey::with('questions.options')->findOrFail($surveyId);
        $answers = Answer::whereIn('question_id', $survey->questions->pluck('id'))->get();

        // Analyze answers here
        // Example: Count responses for each question option

        return view('reports.index', compact('survey', 'answers'));
    }
}

