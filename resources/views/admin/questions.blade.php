@extends('admin_layout.template')
@section('main-content')
<div class="ques_ans_content">
    <div class="first_section">
        <div class="bg-white">
            <div class="row align-items-center">
                <div class="page_title">
                    <div>
                        <h5 class="page-title p-3 mt-2"><span><i class="fa-regular fa-circle-left"
                                    id="back_btnn"></i></span> Q&A</h5>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success mt-3 mx-5">Add Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q1.</span> What do you mean by Laravel ?</h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;Laravel is a
                        free and open-source PHP web framework, created by Taylor Otwell and intended for
                        the development of web applications following the model–view–controller
                        architectural pattern and based on Symfony.</p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q2.</span> What is the latest version of Laravel and its release date ?</h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;The
                        Latest version of Laravel is 9.2.1 and its release date is 27 April 2022.</p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q3.</span> What is Composer ?</h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;Composer
                        is the package manager for the framework. It helps in adding new packages from the
                        huge community into your laravel application.</p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q4.</span> What are available databases supported by Laravel?
                    </h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;The
                        supported databases in laravel are: <br>
                        &nbsp;&nbsp;<i class="fa-regular fa-1"></i>.&nbsp;&nbsp;&nbsp;PostgreSQL <br>
                        &nbsp;&nbsp;<i class="fa-regular fa-2"></i>.&nbsp;&nbsp;&nbsp;SQL Server <br>
                        &nbsp;&nbsp;<i class="fa-regular fa-3"></i>.&nbsp;&nbsp;&nbsp;SQLite <br>
                        &nbsp;&nbsp;<i class="fa-regular fa-4"></i>.&nbsp;&nbsp;&nbsp;MySQL</p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q5.</span> What is Composer ?</h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;Composer
                        is the package manager for the framework. It helps in adding new packages from the
                        huge community into your laravel application.</p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div id="white_boxes">
                    <h4><span>Q6.</span> What is the templating engine used in Laravel?</h4>
                    <p><span><i class="fa-regular fa-equals"></i><i
                                class="fa-solid fa-greater-than"></i></span>&nbsp;&nbsp;&nbsp;
                        The templating engine used in Laravel is Blade. The blade gives the ability to use
                        its mustache-like syntax with the plain PHP and gets compiled into plain PHP and
                        cached until any other change happens in the blade file. The blade file has
                        .blade.php extension.
                    </p>
                    <span><i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i
                            class="fa-solid fa-pencil"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
