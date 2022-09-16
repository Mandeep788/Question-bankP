@section('main-content')

<input type="text" id="tech_id" value="" hidden >
<input type="text" id="frame_id" value="" hidden>
<input type="text" id="experiance_id" value="" hidden>

<div class="container div2" >
    <div class="row">
        @foreach ($frame1 as $f)
        <div class="col-md-6  div1">
            <h2 style=" margin-left:2px;">
                <a href="#" class="frame1">
                    {{ $f->framework_name }}
                </a>
            </h2>
            <a href="#" class="btn btn-default mt-5  link" data-id="{{ $f->id }}" data-techid="{{$f->technology_id}}">Learn More..</a>
        </div>
        @endforeach

    </div>
</div>
<div class="tech_display" id="tech_question_display">
    <div class="d-flex">
        <div class="container d-flex ">
            <div class="back_btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="mb-1 bi bi-arrow-left-circle-fill" viewBox="0 0 16 16" id="icon-back">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
             </div>
             <div class="experieance_table" >
                 <select  class="form-select"  id="experience_id">
                <option value="0" selected>All</option>
                <option value="1">Beginner</option>
                <option value="2">Intermediate</option>
                <option value="3">Advanced</option>
                 </select>
             </div>
        </div>
    </div>
    <div class="question_display " id="question">
        <div class="row justify-content-center p-5" id="ques">
           
        </div>

    </div>
    <div class="page_loader">
        <button class="pageloader_button" id="pageloader_button">Load more...</button>
        <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
            class="page_loader_image"id="page_loader_image" height="80px" width="300px" />
    </div>
</div>



@endsection
@extends('user_layout.template')
