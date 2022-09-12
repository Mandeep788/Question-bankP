@extends('user_layout.template')
@section('main-content')


<div class="container-fluid p-0">
    <div class="container-fluid p-4"style="background-color:black;height:70px; color:white;text-align:center;">Take a Quiz    </div>

    <div class="section" style="">
        <form  action="" method="post">
        @csrf
                @foreach ($quiz_question as $key=>$data)

        <div class="question_section shadow">
            Q.
            {{$loop->iteration}}
            {{$data->question }}
        </div>
        <div class="md-form mt-3 amber-textarea active-amber-textarea">
            <input type="text" class="q_" value="{{$data->id}}" hidden/>
            <input type="text"id="block_id" value=" {{$data->block_id}}" hidden>
            <input type="text"id="quiz_id" value=" {{$data->u}}" hidden>


            <textarea id="form22"  class="md-textarea form-control text-info text-black" data-id="{{$loop->iteration}}" rows="3" placeholder="write your Answer"></textarea>
            <i class="bi bi-pen-fill edit btn btn-default" data-id=""></i>
            <input type="text" class="last_id" value="" hidden/>
            <button class="btn btn-primary enter " style="margin-left:120px">Insert</button>
            <button class="btn btn-primary update" style="margin-left:120px">Update</button>
        </div>
        @endforeach
    </form>

        <button class="btn btn-primary mt-2 mb-5" name="submit" id="submit"style="width:20%;margin-left:10%;" >submit</button>


    </div>


</div>



@endsection
