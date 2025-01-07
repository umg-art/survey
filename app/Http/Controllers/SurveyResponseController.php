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

