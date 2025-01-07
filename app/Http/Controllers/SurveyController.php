<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller
{
    public function create()
    {
        return view('surveys.create');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $survey = Survey::with('survey_Question')->select(['id', 'name', 'age', 'gender']);

            return DataTables::of($survey)
                ->addColumn('questions', function ($survey) {
                    // Get all questions and join them with line breaks
                    return $survey->survey_Question->pluck('question_text')->implode('<br>');
                })
                ->addColumn('action', function ($survey) {
                    return '
                    <a href="' . route('surveys.edit', $survey->id) . '" class="btn btn-sm btn-primary edit-btn">Edit</a>

                  <form action="' . route('surveys.destroy', $survey->id) . '" method="POST" style="display: inline-block;">
                     <input type="hidden" name="_token" value="' . csrf_token() . '">
                     <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-sm btn-danger delete-btn" onclick="return confirm(\'Are you sure you want to delete this survey?\')">Delete</button>
                 </form>
                    ';
                })
                ->rawColumns(['questions', 'action']) // Mark HTML content as raw
                ->addIndexColumn()
                ->make(true);
        }

        return view('surveys.index');
    }

    public function edit($id)
    {
        $survey = Survey::with('survey_Question.survey_QuestionOption')->findOrFail($id);
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'questions' => 'required|array',
        ]);

        $survey = Survey::findOrFail($id);
        $survey->update($validated);

        // Update questions and options
        foreach ($request->questions as $questionId => $questionData) {
            $question = Question::findOrFail($questionId);
            $question->update([
                'question_text' => $questionData['text'],
                'question_type' => $questionData['type'],
            ]);

            foreach ($questionData['options'] as $optionId => $optionText) {
                $option = QuestionOption::findOrFail($optionId);
                $option->update(['option_text' => $optionText]);
            }
        }

        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully!');
    }

    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);

        foreach ($survey->survey_Question as $question) {
            $question->survey_QuestionOption()->delete();
            $question->delete();
        }

        $survey->delete();

        return view('surveys.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'survey_name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
        ]);

        $user =  $request->validate(([
            'name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
        ]));
        $survey = Survey::create($validated);
        User::create($user);

        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'survey_id' => $survey->id,
                'question_text' => $questionData['text'],
                'question_type' => $questionData['type'],
            ]);

            foreach ($questionData['options'] as $optionText) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                ]);
            }
        }

        return redirect()->route('surveys.index');
    }
}
