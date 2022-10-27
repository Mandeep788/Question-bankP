@extends('admin_layout.template')
@section('main-content')
    <input type="text" name="quiz_technology_id" id="quiz_technology_id" hidden>
    <input type="text" name="quiz_technology_name" id="quiz_technology_name" hidden>
    <input type="text" name="mcq_framework_id" id="mcq_framework_id" hidden>
    <input type="text" name="quiz_framework_name" id="quiz_framework_name" hidden>
    <div class=content>
        <div class="row">
            <div id="Technologynmae">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="bread_home" href="#">Technologies</a></li>
                </ol>
            </div>
            <div id="frameWorksT">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="bread_home" href="#">Technologies</a></li>
                    <li class="breadcrumb-item active bread_tech" aria-current="page">Frameworks</li>
                </ol>
            </div>
            <div class="container-fluid">
                <div class="technologyName">
                    <div class="row justify-content-left">
                        @foreach ($technologies as $technology)
                            <div class="col-lg-4 col-md-12">
                                <div id="quizBox">
                                    <div id="click_quiz" data-id="{{ $technology->id }}">
                                        <h4>{{ $technology->technology_name }}</h4>
                                    </div>
                                    <div id="iconn_gap">
                                        <input type="checkbox" data-id="{{ $technology->id }}" class="technologyCheck">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <button id="GoNext" class="btn btn-success">Next </button>
                    </div>
                </div>
                <div id="frameworksNamee">

                </div>
            </div>
        </div>
    </div>


    {{-- extra code --}}
    <div id="load_Mcq_quiz">
        <div class="mcq_content">
            <div class="first_section">
                <div class="bg-whitee">
                    <div class="row align-items-center">
                        <div class="page_titlee">
                            <div class="abcdef">
                                <h6 class="page-title p-3 mt-2">
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a class="bread_home"
                                                    href="#">Technologies</a></li>
                                            <li class="breadcrumb-item"><a class="bread_technology"
                                                    href="#">Frameworks</a></li>
                                            <li class="breadcrumb-item active bread_frame" aria-current="page">Questions
                                            </li>
                                        </ol>
                                    </nav>
                                </h6>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <select id="McqPageLimit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="mcq_experience"
                                        class="form-select mt-3 mx-3 w-75 dropdown_quiz_experience">
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
            <div id="dynamic_frameworks_quiz" class="container-fluid">


            </div>
            {{-- select mcq --}}
            <div id="mcq_quiz" class="container-fluid">
                <div class="first_section">
                    <div class="bg-whitee">
                        <table id="Mcqquestions" class="table table-hover">
                            <thead class="table-dark">
                                <th><input type="checkbox" id="select-all-mcq"></th>
                                <th>S.N.</th>
                                <th>Quiz Questions</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <form id="McqDescriptionForm" method="POST">
                                            <label for="mcqDescription"><strong>Description</strong></label>
                                            <input type="text" name="mcqDescription" id="mcqDescription"
                                                class="mcqDescription">
                                            <div class="text-danger errorspan"></div>
                                            <br>
                                            <input type="text" id="typeMCQ" value="MCQ" hidden>
                                            <label for="mcqTimer"><strong>Timer</strong></label>
                                            <input type="text" name="mcqTimer" id="mcqTimer" class="mcqTimer"
                                                placeholder="In Minutes">
                                            <div class="text-danger errorspan"></div>
                                            <button type="submit" class="btn btn-primary mcq_test">Create Quiz</button>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="noDataFound">

                </div>
            </div>

            <!-- Modal -->
{{-- 
            <div class="page_loaderr">
                <button class="pageloader_button" id="pageloader_mcq_button">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
            </div> --}}
        </div>
    </div>
    <div>
        <br>
        <br>
    </div>
@endsection
