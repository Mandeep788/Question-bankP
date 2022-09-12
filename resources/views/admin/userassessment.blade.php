@extends('admin_layout.template')
@section('main-content')
<input type="text" name="store_aggregate" id="store_aggregate" hidden>
<input type="text" name="store_quiz_id" id="store_quiz_id" hidden>

    <div id="submitted_block" class="container ">

        @foreach ($submittedblock as $block)
            <div class="show_block p-5 m-5 border shadow-sm bg-body rounded">


                {{ $block->name }}
                <br>
                {{ $block->block_name }}
                <br>
                {{ $block->submitted_at }}
                <br>
                <button id="show_submitted_block" data-id="{{ $block->id}}"
                    type="button" class="btn btn-info">View Submitted Block</button>
            </div>
        @endforeach
    </div>
    <div id="feedback_div">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="page-title p-3 mt-2">View Assessment</h5>
                    </div>
                </div>
            </div>
        </div>

        <div id="dynamic_submitted_block" class="container-fluid">

        </div>
        <div id="" class="container-fluid">
        <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div id="white_box">
                        <div class="row justify-content-left">
                            <div class="col-lg-12 col-md-12">
                                <div id="white_box">
                                    <div class="test_btn">
                                        <button class="test_marks_btn" id="test_marks_btn">Submit Test Marks</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
      <br><br>

    </div>
@endsection
