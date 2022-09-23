@extends('user_layout.template')
@section('main-content')

    <div class="container d-flex">
        <div class="row four">
            @foreach($frame2 as $f)
            <div class="col-md-3  three">
                <h3>{{$f->framework_name}}</h3>
                    <a href="#" id="clickMe" class="btn btn-primary mt-5" data-id="{{$f->id}}" data-techid="    {{$f->technology_id}}">Click Me...
                    </a>
            </div>
            @endforeach
        </div>
    </div>     

@endsection
