@extends('admin_layout.template')
@section('main-content')

@foreach($technologies as $techno)
<button class= "btn btn-info mt-2 mcqQuestion" data-id="{{$techno->id}}">{{$techno->technology_name}}</button>
@endforeach
<div class="con" id="mcq">

</div>
@endsection

