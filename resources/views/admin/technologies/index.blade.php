@extends('admin_layout.template')
@section('main-content')
    {{-- @dd($technologies) --}}
    <!--Add Technology Modal -->
    <div class="modal fade" id="addTechnologyModal" tabindex="-1" aria-labelledby="addTechnologyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTechnologyModalLabel">Add Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTechnologyForm" action="{{ url('admin/technologies') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="technology_name">Technology</label>
                            <input type="text" class="form-control" name="technology_name" id="technology_name"
                                placeholder="Technology Name">
                        </div>

                        <div class="form-group">
                            <label for="technology_description">Technology Description</label>
                            <textarea class="form-control" name="technology_description" id="technology_description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="add_technology" class="btn btn-primary">Add Technology</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Edit Technology Modal -->
    <div class="modal fade" id="editTechnologyModal" tabindex="-1" aria-labelledby="editTechnologyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTechnologyModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12">
                                <div id="white_box">
                                    <form action="{{ url('admin/technologies') }}" method="POST">
                                        @csrf
                                        <div class="framework_input">
                                            <input type="text" placeholder="Add Technologies" name="technology_name"
                                                id="technology_name">
                                        </div>
                                        <div class="textarea mt-5">
                                            <textarea name="technology_description" id="technology_description" placeholder="Description" cols="110"
                                                rows="10"></textarea>
                                        </div>
                                        <div class="add_btn">
                                            <button type="submit" id="back_to_tech"
                                                class="btn btn-success px-5 mt-3">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="tech_content" id="add_tech_content">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="page-title p-3 mt-2">Technologies</h5>
                        </div>
                        <div>
                            {{-- <a href="{{url('admin/technologies/add')}}"> --}}
                            <button type="button" id="add_tech" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal"
                                data-bs-target="#addTechnologyModal">Add Technologies</button>
                            {{-- </a> --}}
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
                            <div id="clickable">
                                <h4>{{ $technology->technology_name }}</h4>
                            </div>
                            <div id="icons_gap">
                                <a href="">
                                    <i id="delete_icon" class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                </a>
                                <a href="">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>




    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            //Show Records

            function fetchAllTechnologies() {
                $.ajax({
                    type: "get",
                    url: "{{ route('show') }}",

                    success: function(response) {
                        console.log(response);
                    }
                });
            }

            // Add Technologies

            $('#addTechnologyForm').submit(function(e) {
                e.preventDefault();
                // alert();
                var Tech_form = new FormData(this);
                // console.log(this);
                $('#add_technology').text('Adding...');
                $.ajax({
                    type: "POST",
                    url: "{{ route('create') }}",
                    data: Tech_form,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    // contentType:false,
                    success: function(response) {

                        if (response.status == 200) {
                            swal.fire(
                                'Added',
                                'Technology Added Successfully',
                                'success'
                            )
                        }
                        $('#add_technology').text('Add Technology');
                        $('#addTechnologyForm')[0].reset();
                        $('#addTechnologyModal').modal('hide');

                    }
                });

            });
        });
    </script>
@endsection
