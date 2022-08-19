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
            <div class="white_box ">
                <h3 class="box-title">Total Users</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-chart-simple text-success"></i><i class="fa-solid fa-chart-simple text-success"></i></h4>
                    <li class="ms-auto"><span class="counter text-success"><h4>630</h4></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white_box analytics-info">
                <h3 class="box-title">Technologies</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-book text-primary"></i></h4>
                    <li class="ms-auto"><span class="counter text-primary"><h4>30</h4></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white_box analytics-info">
                <h3 class="box-title">Unique Visitors</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <h4><i class="fa-solid fa-users text-info"></i>                       </h4>
                    <li class="ms-auto"><span class="counter text-info"><h4>561</h4></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div id="white_box">
                <h3 class="box-title">Users</h3>
                    <table class="table table-hover">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Technologies</th>
                        <th>Experience</th>
                        <th>level</th>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>kavi</td>
                        <td>Java</td>
                        <td>1 year</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ravi</td>
                        <td>Python</td>
                        <td>3 year</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Raushan</td>
                        <td>Flutter</td>
                        <td>6 year</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Suraj</td>
                        <td>PHP</td>
                        <td>1 year</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Rabina</td>
                        <td>ReactJS</td>
                        <td>4 year</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Hari</td>
                        <td>GoLang</td>
                        <td>2 year</td>
                        <td>6</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
