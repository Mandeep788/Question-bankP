@extends('admin_layout.template')
@section('main-content')

<div class="container p-5">

    <div class="emaildetails shadow p-4">
        <b><h2>Sending Email </h2></b><hr>
    <form action="/mail" method="post">
        @foreach ($details as $data)
        @csrf
        @method("post")
        <input type="text" value="{{$data->id}}" name="id" >
        <div class="form-group mb-3">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="name" value ="{{$data->name}}" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="Block Nname">Block Name</label>
            <input type="text" class="form-control mb-3" id="blockname" value ="{{$data->block_name}}"name="block_name">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="email" value ="{{$data->email}}"name="email">
        </div>
        <div class="form-group">
            <label for="Subject">Subject</label>
            <input type="text" class="form-control" id="subject" value =""name="subject">
        </div>
        <div class="form-group">
            <label for="Email">Message</label>
            <input type="text" class="form-control" id="emal" value ="" name="message">
        </div>
      <button type="submit" class="btn btn-success mt-3">Send Mail</button>
      @endforeach
    </form>
    </div>
  </div>

@endsection
