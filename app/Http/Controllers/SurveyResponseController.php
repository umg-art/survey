<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyResponseController extends Controller
{
    public function show($id)
    {
        $survey = Survey::with('questions.options')->findOrFail($id);
        return view('surveys.take', compact('survey'));
    }

    public function getSurvey(Request $request) {
      if($request) {
        $survey = Survey::all();
         if(count($survey) > 0) {
            // dd($survey);
            return view('user.index', compact('survey'))->with('success', 'Survey fetch successfully!');
         }
         else {
            return view('user.index')->with('success', 'Survey fetch successfully!');
         }
      }
    }

    public function getSurveyById($id) {
        if($id) {
            $survey = Survey::with('survey_Question.survey_QuestionOption')->findOrFail($id);
            // dd($survey->survey_Question);
            return view('user.getsurvey', compact('survey'));
        }
      }

    public function submit(Request $request, $id)
    {
        // Store user info
        $user = User::create($request->only('name', 'age', 'gender'));

        // Store responses
        foreach ($request->answers as $questionId => $answer) {
            Answer::create([
                'user_id' => $user->id,
                'question_id' => $questionId,
                'answer' => $answer,
            ]);
        }

        return redirect()->route('surveys.thank_you');
    }
}

