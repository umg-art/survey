@extends('layout.app')

@section('content')


    @if ($survey)
        <div class="container">
            <div class="d-flex justify-content-between mt-4 mb-3">

                <h3>Start survey with {{ $survey->name}}</h3>
            </div>

            <form id="surveyForm" action="{{ route('surveys.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="surveyName">user Name:</label>
                    <input type="text" name="name" id="surveyName" placeholder="enter survey name"
                        class="form-control mt-3" required>
                </div>
                <div class="form-group">
                    <label for="surveyAge">Age:</label>
                    <input type="number" name="age" id="surveyAge" placeholder="enter age" class="form-control mt-3"
                        required>
                </div>
                <div class="form-group">
                    <label for="surveyGender">Gender:</label>
                    <select name="gender" id="surveyGender" class="form-control mt-3" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <hr>
                <h5>Questions :</h5>
                <br>
                <div id="questionsSection">
                    @foreach ($survey->survey_Question as $index => $question)
                        <div class="question-container">
                            <div name="questions{{ $question->id }}" class="form-control mt-3 question-text">
                                <strong>Question {{ $index + 1 }}: {{ $question->question_text }} </strong>
                            </div>
                            <div class="form-group answer-options">
                                <div class="option-container form-control">
                                    @foreach ($question->survey_QuestionOption as $option)
                                        <div class="d-flex gap-2">
                                            <input type="{{ $question->question_type}}" id="{{ $option->option_text}}" name="{{ $option->option_text}}" value="{{ $option->option_text }}">
                                            <label for="{{ $option->option_text}}">{{  $option->option_text }}</label>
                                            <br>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection
