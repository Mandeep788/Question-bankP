@extends('admin_layout.template')
@section('main-content')
<div class="framework_content">
    <div class="first_section">
        <div class="bg-white">
            <div class="row align-items-center">
                <div class="page_title">
                    <div>
                        <h5 class="page-title p-3 mt-2"><span><i class="fa-regular fa-circle-left" id="back_btn"></i></span> Frameworks</h5>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success mt-3 mx-5">Add Frameworks</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12">
                <div id="white_boxx">
                    <h4>Laravel</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div id="white_box">
                    <h4>Symfony</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div id="white_box">
                    <h4>CodeIgniter</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
