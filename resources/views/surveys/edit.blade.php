@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Survey</h2>

    <form id="surveyForm" action="{{ route('survey.submit', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="surveyName">Survey Name:</label>
            <input type="text" name="name" id="surveyName" class="form-control mt-3" value="{{ $survey->name }}" required>
        </div>

        <div class="form-group">
            <label for="surveyStatus">Status:</label>
            <select name="status" id="surveyStatus" class="form-control mt-3" required>
                <option value="published"  {{ $survey->status == 'published' ? 'selected' : '' }}>Active</option>
                <option value="draft"  {{ $survey->status == 'draft' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div id="questionsSection">
            @foreach ($survey->survey_Question as $index => $question)
            <div class="question-container">
                <div class="form-group">
                    <label>Question {{ $index + 1 }}</label>
                    <input type="text" name="questions[{{ $question->id }}][text]" class="form-control mt-3 question-text" value="{{ $question->question_text }}" required>
                </div>

                <div class="form-group">
                    <label>Question Type:</label>
                    <select name="questions[{{ $question->id }}][type]" class="form-control mt-3 question-type" required>
                        <option value="checkbox" {{ $question->question_type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                        <option value="radio" {{ $question->question_type == 'radio' ? 'selected' : '' }}>Radio Button</option>
                        <option value="text" {{ $question->question_type == 'text' ? 'selected' : '' }}>Text Input</option>
                    </select>
                </div>

                <div class="form-group answer-options">
                    <label>Answer Options:</label>
                    <div class="option-container">
                        @foreach ($question->survey_QuestionOption as $option)
                        <input type="text" name="questions[{{ $question->id }}][options][{{ $option->id }}]" class="form-control mt-3 answer-option" value="{{ $option->option_text }}" required>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary text-white">Update Survey</button>
        </div>
    </form>
</div>
@endsection
