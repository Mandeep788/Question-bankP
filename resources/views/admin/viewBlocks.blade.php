@extends('admin_layout.template')
@section('main-content')
<input type="text" name="store_block_id" id="store_block_id" hidden>
  <div id="show_blocks">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Quiz</h5>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select id="show_blocks_limit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="block_data" class="container-fluid">
            <div class="first_section">
                <div class="bg-white">
                    <table class="table table-hover">
                        <thead class="">
                            <th>S.N.</th>
                            <th>Quiz Blocks</th>
                            <th>Number of Questions</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($blocks as $block)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $block->block_name }}</td>
                                    <td>{{ $block->question_count }}</td>
                                    <td>
                                        <button id="show_block_btn" type="button" data-id="{{ $block->id }}"
                                            class="btn btn-info"><i class="fa-solid fa-eye"></i>&nbsp;Show</button>
                                        {{-- <button type="button" data-id="{{ $block->id }}"
                                            class="btn btn-danger delete_block_btn"><i
                                                class="fa-solid fa-trash"></i>&nbsp;Delete</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        {{-- <div class="page_loader">
            <button class="pageloader_button" id="pageloader_quiz_button">Load more...</button>
            <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
        </div> --}}
    </div>
    <div id="show_block_data">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Block Detail</h5>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select id="block_data_limit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                            </div>
                            <div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_questions">
            <div class="first_section">
                <div class="bg-white">
                    <table id="block_table" class="table table-hover">
                        <thead class="">
                            <th>S.N.</th>
                            <th>Block Questions</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="load_users_list">

        <div class="users_content">
            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="page_title">
                            <div>
                                <h5 class="page-title p-3 mt-2">Users</h5>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <select id="users_list_limit" class="form-select mt-3 mx-3 w-75 dropdown_pagination">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div> --}}
            <div id="dynamic_users_detail" class="container-fluid">
                <div class="first_section">
                    <div class="bg-white">
                        <table id="users_detail_table" class="table table-hover">
                            <thead class="table-dark">
                                <th>#</th>
                                <th>S.N.</th>
                                <th>User Name</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="page_loader">
                <button class="pageloader_button" id="pageloader_quiz_button">Load more...</button>
                <img src="{{ asset('img/pageloader.gif') }}" alt="Show/Hide Image"
                    class="page_loader_image"id="quiz_page_loader_image" height="80px" width="300px" />
            </div> --}}



        </div>
    </div>
    <br>
    <br>
@endsection
