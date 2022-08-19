@extends('admin_layout.template')
@section('main-content')
    <div class="add_tech_content">
        <div class="first_section">
            <div class="bg-white">
                <div class="row align-items-center">
                    <div class="page_title">
                        <div>
                            <h5 class="p-3 mt-3"> Add Technologies</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div id="white_box">
                        <form action="{{url('admin/technologies')}}" method="POST">
                            @csrf
                            <div class="framework_input">
                                <input type="text" placeholder="Add Technologies" name="technology_name" id="technology_name">
                            </div>
                            <div class="textarea mt-5">
                                <textarea name="technology_description" id="technology_description" placeholder="Description" cols="110" rows="10"></textarea>
                            </div>
                            <div class="add_btn">
                                <button type="submit" id="back_to_tech" class="btn btn-success px-5 mt-3">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
