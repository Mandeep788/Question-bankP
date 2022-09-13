@extends('admin_layout.template')
@section('main-content')
    <input type="text" name="quiz_technology_id" id="quiz_technology_id" hidden>
    <input type="text" name="quiz_technology_name" id="quiz_technology_name" hidden>
    <input type="text" name="quiz_framework_id" id="quiz_framework_id" hidden>
    <input type="text" name="quiz_framework_name" id="quiz_technology_name" hidden>

    <div id='load_technologies_quiz'>

        <div class="tech_content" id="add_tech_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">Technologies</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-left">
                    @foreach ($technologies as $technology)
                        <div class="col-lg-4 col-md-12">
                            <div id="white_box">
                                <div id="clickable_quiz" data-id="{{ $technology->id }}">
                                    <h4>{{ $technology->technology_name }} &nbsp;<i
                                            class="bi bi-arrow-right-circle icon_hover"></i></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>


    <div id='load_frameworks_quiz'>

        <div class="framework_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">
                                    {{-- <span><i class="fa-regular fa-circle-left"
                                            id="back_btn"></i></span> --}}
                                             Frameworks</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="dynamic_frameworks_quiz" class="container-fluid">


            </div>
        </div>

    </div>

    <div id="load_question_quiz">

        <div class="ques_ans_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">
                                    {{-- <span><i class="fa-regular fa-circle-left"
                                            id="back_btnnn"></i></span> --}}
                                             Quiz</h5>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <select id="quiz_page_limit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="quiz_experience" class="form-select mt-3 mx-3 w-75 dropdown_quiz_experience">
                                        <option value="0" selected>All</option>
                                        <option value="1">Beginner</option>
                                        <option value="2">Intermediate</option>
                                        <option value="3">Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="dynamic_question_quiz" class="container-fluid">
                <div class="first_section">
                    <div class="bg-white">
                        <table id="test_table" class="table table-hover">
                            <thead class="table-dark">
                                <th>#</th>
                                <th>S.N.</th>
                                <th>Quiz Questions</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" id="select-all"><span>&nbsp;&nbsp;&nbsp;&nbsp; Select All</span>
                                    </td>
                                    <td>
                                        <form>
                                        <label for="test_description">Description</label>
                                        <input type="text" name="test_description" id="test_description" class="test_description" required>
                                        <button type="submit" class="btn btn-primary make_test">Create Quiz</button>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="page_loader">
                <button class="pageloader_button" id="pageloader_quiz_button">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
            </div>



        </div>
    </div>
    <div>
        <br>
        <br>
    </div>
@endsection
