@extends('admin_layout.template')
@section('main-content')
    <div class="first_section">
        <div class="bg-white">
            <div class="row align-items-center">
                <div class="page_title">
                    <div>

                    </div>
                    <div class="bddTech">
                        <!-- Modal of add question and answer outer-->
                        <button type="button" class="btn btn-success mt-3 mx-5 addTech" data-bs-toggle="modal"
                            data-bs-target="#outerAddModal">Add Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($technologies as $techno)
        <button class="btn btn-info mt-2 mcqQuestion" data-id="{{ $techno->id }}">{{ $techno->technology_name }}</button>
    @endforeach
    <div class="con" id="mcq">

    </div>
    <div class="conn" id="mcq_q">

    </div>
    <div class="connn" id="mcq_a">

    </div>

    <!-- Modal of mcqQuestions edit inner-->
    <div class="modal fade" id="mcqModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Add Question"><br>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!--end of modal-->

    <!-- Modal of add question and answer outer-->
    <div class="modal fade" id="outerAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="post" class="form3" action="{{ url('/admin/mcq_questions/addMcq') }}">
                        @csrf
                        <input type="text" class="form-control" id="mcq_frameworkid" name="frameworkId" value=""
                            placeholder="Add Question" hidden><br>
                        <select name="experience" class="form-select form-select-lg mb-3"
                            aria-label=".form-select-lg example">

                            @foreach ($experiences as $experience)
                                <option value="{{ $experience->id }}">{{ $experience->experience_name }}</option>
                            @endforeach
                        </select>

                        <input type="text" class="form-control" id="mcq_question" name="mcq_question" value=""
                            placeholder="Add Question"><br>



                            <input type="text" class="form-control" id="mcq_answer" name="mcq_answer[]" value=""
                                placeholder="Add Answer option 1"><br>
                            <input type="text" class="form-control" id="mcq_answer" name="mcq_answer[]" value=""
                                placeholder="Add Answer option 2 "><br>
                            <input type="text" class="form-control" id="mcq_answer" name="mcq_answer[]" value=""
                                placeholder="Add Answer option 3 "><br>
                            <input type="text" class="form-control" id="mcq_answer" name="mcq_answer[]" value=""
                                placeholder="Add Answer option 4 "><br>

                        <input type="text" class="form-control" id="correctAnswer" name="correctAnswer" value=""
                            placeholder="Correct Answer"><br>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <br>
    <br>
    <!--end of modal-->
@endsection
