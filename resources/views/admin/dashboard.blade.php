@extends('admin_layout.template')
@section('main-content')



<div class="first_section">
    <div class="bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="page-title p-3 mt-2">Dashboard</h5>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12 ">
            <div class="big_box">
                <div class="white_box">
                <h3 class="box-title text-success">Total Users</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-chart-simple text-success"></i><i class="fa-solid fa-chart-simple text-success"></i></h4>
                    <li class="ms-auto"><span class="counter text-success"><h4>630</h4></span></li>
                </ul>
                </div>
                <div class="more_info"><span class="more_info_text">More Info.</span></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="big_box">
            <div class="white_box analytics-info">
                <h3 class="box-title text-primary">Technologies</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-book text-primary"></i></h4>
                    <li class="ms-auto"><span class="counter text-primary"><h4>330</h4></span></li>
                </ul>
            </div>
            <div class="more_info_tech"><span class="more_info_text_tech">More Info.</span></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="big_box">
            <div class="white_box analytics-info">
                <h3 class="box-title text-info">Total Q&A</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-users text-info"></i>                       </h4>
                    <li class="ms-auto"><span class="counter text-info"><h4>561</h4></span></li>
                </ul>
            </div>
            <div class="more_info_qa"><span class="more_info_text_qa">More Info.</span></div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div id="white_box">
                <h3 class="box-title">Users</h3>
                    <table class="table table-hover">
                        .
                        .
                        .
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
