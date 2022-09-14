@extends('admin_layout.template')
@section('main-content')
<input type="text" name="store_aggregate" id="store_aggregate" hidden>
<input type="text" name="store_quiz_id" id="store_quiz_id" hidden>

    <div id="submitted_block" class="container p-0 ">

        @foreach ($submittedblock as $block)
            <div class="show_block p-5 m-3  border shadow-sm bg-body rounded">


                <h4>{{ $block->name }}</h4>
            
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
        <!-- Modal -->
<div class="modal fade" id="FeedbackModal" tabindex="-1" aria-labelledby="FeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="FeedbackModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="form-group">
                  <label for="AggergateMarks">Aggergate Marks</label>
                  <input type="text" class="form-control" id="AggergateMarks" disabled>
                </div>
                <div class="form-group">
                  <label for="Feedback">Feedback</label>
                  <textarea class="form-control" id="Feedback" rows="3" placeholder="Please give feedback!!"></textarea>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="FeedbackBtn" class="btn btn-primary">Okay!!</button>
        </div>
      </div>
    </div>
  </div>
        <div id="" class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row justify-content-left">
                        <p class="text-danger CheckUncheck text-center"></p>
                            <div class="test_btn">
                                <button class="test_marks_btn mb-5" id="test_marks_btn">Submit Test Marks</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
      <br><br>

    </div>
@endsection
