@extends('user_layout.template')
@section('main-content')
    <!-- crousel code area start----------------------------------------- -->

    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

                @foreach($sliders as $slider)
                    <div class="carousel-item active">
                        <img src="{{url('user_img\img')}}/{{$slider->image}}" class="d-block w-100"  alt="..."> 
                    </div>
                @endforeach
                 <!-- The slideshow/carousel -->
          
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
                            <h5 class="card-title" style="">
                                {{ $items->technology_name }}
                            </h5>
                            <p class="card-text">
                                {{ $items->technology_description }}
                            </p>

                             <a href="" class="cardtech btn btn-default mt-2" data-id="{{ $items->id }}" style="border:1px solid green;" >Learn More..</a>
                        </div>
                      </div>

                </div>
            @endforeach

            {{-- technology with small and multiple div ------------------------- --}}


            <div class="slider">
                <h2 class="text">Lets See our Popular Technologies</h2>
                <div class="gallery js-flickity"data-flickity-options='{ "wrapAround": true }'>

                    @foreach ($technologies3 as $items)
                        <div class="gallery-cell cell_one">
                            <h4 class="tech_name">
                                {{ $items->technology_name }}
                            </h4>
                            <a href="#" class="btn btn-primary slidertech " data-id="{{ $items->id }}" style="margin-top:2%">Learn More..</a>

                        </div>
                    @endforeach

                </div>

            </div>

            {{-- multiple slider divss of technology--------------------------- --}}
        @endsection
