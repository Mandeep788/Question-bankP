@extends('user_layout.template')
@section('main-content')

    <div class="container-fluid p-0">
        <div class="container-fluid p-4 quiz_question">Test Your MCQ</div>
        <div id="gettingMcqTimer" class=""></div>

        <div class="container mt-5">
            <div class="mcqQuesSection">
                @csrf
                @foreach ($quizQuestionData as $key=>$mcq)
                    <input type="hidden"id="mcqStartTime" value="">
                    <div class="mcqQues">
                        <h4>Q{{$key + 1}}.  {{$mcq['question']}}</h4>
                    </div>

                    <div class="mcqAns form-group mt-3">
                        @foreach ($mcq['answer'] as $mcqAnswer)
                        <div class="mcqEachAns">
                            <input class="form-group-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-group-label mx-2" for="flexRadioDefault1">{{$mcqAnswer->mcq_answers}}</label>
                        </div>
                        @endforeach
                    </div>
                @endforeach
            </div>


        </div>
    </div>

@endsection
