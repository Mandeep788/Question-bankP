@extends('user_layout.template')
@section('main-content')



<!-- edit profile modal code area-------------- ------>
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
          

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

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
            <img src="{{asset('user_img/img/question.png')}}" alt="Los Angeles" class="d-block"
                style="width:100%; height:490px; padding:0px;">
            <div class="carousel-caption">

            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('user_img/img/login.png')}}" alt="Chicago" class="d-block"
                style="width:100%; height:490px;">
            <div class="carousel-caption">

            </div>
        </div>
        <div class="carousel-item">
            <img src="https://www.glassdoor.com/employers/app/uploads/sites/2/2021/02/GoogleDrive_640X469_8-Key-Interview-Questions-to-Ask-in-the-Age-of-COVID-02-768x595.png"
                alt="New York" class="d-block" style="width:100%; height:490px;">
            <div class="carousel-caption">

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
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('user_img/img/php.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">PHP</h5>
                    <p class="card-text"> PHP is a server-side designed specifically for web development.</p>
                    <a href="#" class="btn btn-primary">Learn More..</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('user_img/img/images.jfif')}}" class="card-img-top" alt="..." style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">JAVA</h5>
                    <p class="card-text">PHP is a server-side designed specifically for web development.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('user_img/img/javascript.png')}}" class="card-img-top" alt="..."
                    style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">JAVSCRIPT</h5>
                    <p class="card-text">Some quick example text to content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3  col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('user_img/img/python.webp')}}" class="card-img-top" alt="..." style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">Pyhton</h5>
                    <p class="card-text">Some quick example text to content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- seccnd roww--------------------------------------------------- -->
<div class="container-fluid con">
    <div class="row">
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('user_img/img/php.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">PHP</h5>
                    <p class="card-text"> PHP is a server-side designed specifically for web development.</p>
                    <a href="#" class="btn btn-primary">Learn More..</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="./img/images.jfif" class="card-img-top" alt="..." style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">JAVA</h5>
                    <p class="card-text">PHP is a server-side designed specifically for web development.</p>
                    <a href="#" class="btn btn-success">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3  col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="./img/javascript.png" class="card-img-top" alt="..." style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">JAVSCRIPT</h5>
                    <p class="card-text">Some quick example text to content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-2">
            <div class="card" style="width: 18rem;">
                <img src="./img/python.webp" class="card-img-top" alt="..." style="height:190px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:900;">Pyhton</h5>
                    <p class="card-text">Some quick example text to content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- few techno with large div coding area ends----------------------------------------- -->




<!-- {{-- technology with small and multiple div ------------------------- --}} -->

<div class="section">
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true }'>
        <div class="gallery-cell"></div>
        <div class="gallery-cell"></div>
        <div class="gallery-cell"></div>
        <div class="gallery-cell"></div>
        <div class="gallery-cell"></div>
    </div>
</div>

<!-- {{-- multiple divss of technology--------------------------- --}} -->

@endsection