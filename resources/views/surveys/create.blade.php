@extends('layout.app')

@section('content')
            <div class="container">
                <div class="d-flex justify-content-between mt-4 mb-3">

                    <h3>Create a New Survey</h3>
                   <a href="/surveys" class="btn btn-primary text-white" >Create</a>
                </div>

                <form id="surveyForm" action="{{ route('surveys.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="surveyName">Survey Name:</label>
                        <input type="text" name="survey_name" id="surveyName" placeholder="enter survey name" class="form-control mt-3" required>
                    </div>
                    <div class="form-group">
                        <label for="surveyName">user Name:</label>
                        <input type="text" name="name" id="surveyName" placeholder="enter survey name" class="form-control mt-3" required>
                    </div>
                    <div class="form-group">
                        <label for="surveyAge">Age:</label>
                        <input type="number" name="age" id="surveyAge" placeholder="enter age" class="form-control mt-3" required>
                    </div>
                    <div class="form-group">
                        <label for="surveyGender">Gender:</label>
                        <select name="gender" id="surveyGender" class="form-control mt-3" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div id="questionsSection">
                        <div class="question-container">
                            <div class="form-group">
                                <label>Question 1</label>
                                <input type="text" name="questions[0][text]" class="form-control mt-3 question-text" placeholder="Enter Question" required>
                            </div>

                            <div class="form-group">
                                <label>Question Type:</label>
                                <select name="questions[0][type]" class="form-control mt-3 question-type" required>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="text">Text Input</option>
                                </select>
                            </div>

                            <div class="form-group answer-options">
                                <label>Answer Options:</label>
                                <div class="option-container">
                                    <input type="text" name="questions[0][options][]" class="form-control mt-3 answer-option" placeholder="Enter Answer Option" required>
                                </div>
                                <button type="button" class="btn btn-primary add-answer-option">Add Option</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-success text-white" id="addQuestionBtn">Add More Questions</button>
                        <button type="submit" class="btn btn-primary text-white">Submit Survey</button>
                    </div>
                </form>
            </div>
@endsection


@section('scripts')

    <script>
        $(document).ready(function() {
            let questionIndex = 1;

            $('#addQuestionBtn').click(function() {
                const newQuestion = `
                    <div class="question-container">
                        <div class="form-group">
                            <label>Question ${questionIndex + 1}</label>
                            <input type="text" name="questions[${questionIndex}][text]" class="form-control mt-3 question-text" placeholder="Enter Question" required>
                        </div>

                        <div class="form-group">
                            <label>Question Type:</label>
                            <select name="questions[${questionIndex}][type]" class="form-control mt-3 question-type" required>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio Button</option>
                                <option value="text">Text Input</option>
                            </select>
                        </div>

                        <div class="form-group answer-options">
                            <label>Answer Options:</label>
                            <div class="option-container">
                                <input type="text" name="questions[${questionIndex}][options][]" class="form-control mt-3 answer-option" placeholder="Enter Answer Option" required>
                            </div>
                            <button type="button" class="btn btn-primary add-answer-option">Add Option</button>
                        </div>
                    </div>
                `;
                $('#questionsSection').append(newQuestion);
                questionIndex++;
            });

            // Add New Answer Option
            $(document).on('click', '.add-answer-option', function() {
                const newOption = `
                    <input type="text" name="questions[${questionIndex - 1}][options][]" class="form-control mt-3 answer-option" placeholder="Enter Answer Option" required>
                `;
                $(this).siblings('.option-container').append(newOption);
            });
        });
    </script>

@endsection
