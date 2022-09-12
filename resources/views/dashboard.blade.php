@extends('user_layout.template')
@section('main-content')
    <!-- crousel code area start----------------------------------------- -->

    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner p-0">
            <div class="carousel-item active">
                <img src="{{ asset('user_img/img/one1.jpeg') }}" alt="Los Angeles" class="d-block"
                    style="width:100%; height:490px; padding:0px;">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('user_img/img/login.png') }}" alt="Chicago" class="d-block"
                    style="width:100%; height:490px;">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="carousel-item">
                <img src="https://www.glassdoor.com/employers/app/uploads/sites/2/2021/02/GoogleDrive_640X469_8-Key-Interview-Questions-to-Ask-in-the-Age-of-COVID-02-768x595.png"
                    alt="New York" class="d-block" style="width:100%; height:490px;">
                <div class="carousel-caption text-black justify-content-left">
                    <h1 class="justify-content-left">The New Way To Learn properly In With Us...<h1>
                </div>
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>






    <!-- crousel area code ends-------------------------------------------------------- -->

    <!-- few technology with large div section area--------------------------------- -->

    <div class="container-fluid con">

        <div class="row">
            <h2 class="text">Lets Brows All Technologies</h2>
            @foreach ($technologies2 as $items)
                <div class="col-md-3 col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" >

                            <i class="fa-solid fa-hands-asl-interpreting"style="font-size:40px;"></i>
                         <h5 class="card-title" style="font-weight:700;margin-top:40px; font-size:25px;">
                                {{ $items->technology_name }}
                            </h5>

                            <p class="card-text"style="margin-top:20px; font-size:12px;">
                                {{ $items->technology_description }}
                            </p>

                             <a href="#" class="btn btn-default mt-2"style="border:1px solid green;" >Learn More..</a>
                        </div>
                      </div>

                </div>
            @endforeach

            {{-- technology with small and multiple div ------------------------- --}}


            <div class="section">
                <h2 class="text">Lets See our Popular Technologies</h2>
                <div class="gallery js-flickity"data-flickity-options='{ "wrapAround": true }'>

                    @foreach ($technologies3 as $items)
                        <div class="gallery-cell cell_one">
                            <h4 style="margin-top:20%">
                                {{ $items->technology_name }}
                            </h4>
                            <a href="#" class="btn btn-primary" style="margin-top:2%">Learn More..</a>

                        </div>
                    @endforeach

                </div>

            </div>

            {{-- multiple slider divss of technology--------------------------- --}}
        @endsection
