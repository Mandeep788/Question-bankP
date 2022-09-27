@extends('user_layout.template')
@section('main-content')


<div class="container-fluid p-0">

    <div class="container-fluid p-4 quiz_question">Take a Quiz    </div>
    <div class="section">
        <div style="display:none;" class="videoPlayer">
            <video class="video" width="600px" controls></video>
        </div>
        <div class="d-flex">
            <div>
                <button class="btn btn-success mb-2" id="start"> Start </button>
            </div>
            <div class="alert alert-warning" role="alert">
                Please start recording your screen.
            </div>
        </div>
        <div class="d-flex">
            <div>
                <button class="btn btn-danger mb-2" id="stop" > Stop </button>
            </div>
            <div class="alert alert-warning" role="alert">
                Make sure you stop the recording.
            </div>
        </div>
        
        <div id="getting" class=""></div>
        <br>
        <br>
        <form  action="" method="post">
        @csrf
                @foreach ($quizQuestionData as $key=>$data)

        <div class="question_section shadow">
            Q.{{$loop->iteration}}
            {{-- {{ $quiz_question->firstItem() + $loop->index }} --}}
            {{$data['question'] }}
        </div>
        <div class="md-form mt-3 amber-textarea active-amber-textarea">
            <input type="text" class="q_" value="{{$data['id']}}" hidden/>
            <input type="text"id="block_id" value=" {{$data['block_id']}}" hidden>
            <input type="text"id="quiz_id" value=" {{$data['u']}}" hidden>
            <input type="text"id="quiz_timer" value=" {{$data['timer']}}" hidden>
            <input type="text"id="quiz_started_at" value=" {{$data['started_at']}}" hidden>
            <input type="text"id="quiz_block_name" value=" {{$data['block_name']}}" hidden>
            <input type="text"id="quiz_user_name" value=" {{$data['name']}}" hidden>
            <textarea id="form22"  class="md-textarea form-control text-black text-info" data-id="{{$loop->iteration}}" rows="3" placeholder="write your Answer" value="">{{$data['answer']}}</textarea>
            <span class="skipText">Skipped</span>
            <i class="bi bi-pen-fill btn btn-default edit" data-id=""></i>

            @if($data['answerid']=='')
            <input type="text" class="last_id" value=""hidden/>
            @else
            <input type="text" class="last_id" value="{{$data['answerid']}}"hidden/>
            @endif

            <button class="btn btn-primary enter">Insert</button>
            <button class="btn btn-primary update ">Update</button>
            <input type="button" class="btn btn-warning skipAnswer" value="Skip" id="skipAnswer">
        </div>
        @endforeach
    </form>
        <button class="btn btn-primary mt-2 mb-5" name="submit" id="submit">submit</button>
    </div>
</div>



@endsection
