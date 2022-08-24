@extends('admin_layout.template')
@section('main-content')


<div class="first_section">
     <div class="bg-white">
         <div class="row align-items-center">
             <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                 <h5 class="page-title p-3 mt-2">Profile</h5>
             </div>
         </div>
     </div>
 </div>    
 <div class="container-fluid">
     <div class="row">
         <div class="col-lg-4 col-xlg-3 col-md-12">
             <div class="profile_box">
                 <div class="overlay-box">
                     <div class="user-content">
                         @foreach($data as $row)
                         <img src="" class="user_profile" alt="img">
                             <!-- <input type="file" name="pic" hidden> -->
                         <h4 class="user_name mt-4">{{$row->name}}</h4>
                         <h5 class="user_mail">{{$row->email}}</h5>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-8 col-xlg-9 col-md-12">
             <div class="card" id="white_box">
                 <div class="card-body">
                     <form class="form-horizontal form-material" action="{{ route('profile.update') }}" method="post">
                         @csrf
                         @method('put')
                         @foreach($data as $row)
                         <input id="id" name="id" type="hidden" value="{{$row->id}}">
                         <div for="name" class="form-group mb-4">
                             <label class="col-md-12 p-0">Name</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="text" class="form-control p-2 border-0 mt-3" name="name" id="name" value="{{$row->name}}"> 
                             </div>
                         </div>
                         <div class="form-group mb-4">
                             <label for="email" class="col-md-12 p-0">Email</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="email" class="form-control p-2 border-0 mt-3" name="email" id="email" value="{{$row->email}}">
                             </div>
                         </div>
                         <div class="form-group mb-4">
                             <label class="col-md-12 p-0">Gender</label>
                             <div class="col-md-12  p-3 d-flex">
                                 <input type="radio" value="M" {{ ($row->gender=="M")? "checked" : "" }} class="form-check-input p-2 mt-3" name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Male
                                 </label>
                                 <input type="radio" value="F" {{ ($row->gender=="F")? "checked" : "" }}class="form-check-input p-2 mt-3 " name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Female
                                 </label>
                                 <input type="radio" value="O" {{ ($row->gender=="O")? "checked" : "" }} class="form-check-input p-2 mt-3 " name="gender" id="gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Others
                                 </label>
                             </div>
                         </div>
                         
                         {{-- <div class="form-group mb-4">
                             <label class="col-sm-12">Select Country</label>
                             <div class="col-sm-12 border-bottom">
                                 <select class="form-select shadow-none p-2 border-0 form-control-line mt-3">
                                     <option disabled selected>Choose...</option>
                                     <option name="country" value="korea" {{ ($row->country=="korea")? "selected" : "" }}>Korea</option>
                                     <option name="country" value="India" {{ ($row->country=="India")? "selected" : "" }}>India</option>
                                     <option name="country" value="USA" {{ ($row->country=="USA")? "selected" : "" }}>Usa</option>
                                     <option name="country" value="Nepal" {{ ($row->country=="Nepal")? "selected" : "" }}>Nepal</option>
                                     <option name="country" value="Japan" {{ ($row->country=="Japan")? "selected" : "" }}>Japan</option>
                                 </select>
                             </div>
                         </div> --}}
                         <div class="form-group mb-4">
                             <label class="col-md-12 p-0">Password</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="password" class="form-control p-2 border-0 mt-3" name="password" id="password" value="{{$row->password}}">
                             </div>
                         </div>
                         <div class="form-group my-3">
                             <div class="col-sm-12">
                                 <button class="btn btn-success mt-3" name="updateAdmin" id="updateAdmin">Update Profile</button>
                             </div>
                         </div>
                         @endforeach
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>


@endsection