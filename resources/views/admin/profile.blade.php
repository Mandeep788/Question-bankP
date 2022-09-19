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
                     <div class="user-content" id="preview-image">
                        <img src="" class="preview-image" style="width: 250px;">
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-8 col-xlg-9 col-md-12">
             <div class="card" id="white_box">
                 <div class="card-body">
                    <form class="form-horizontal form-material myform" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" id="myform">
                        @csrf
                        @method('put')
                         <div for="profile_name" class="form-group mb-4">
                             <label class="col-md-12 p-0">Name</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="text" class="form-control @error('profile_name') is-invalid @enderror p-2 border-0 mt-3" name="profile_name" id="profile_name" value="">
                             </div>
                             @error('profile_name')
                             <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            </div>
                         <div class="form-group mb-4">
                             <label for="profile_email" class="col-md-12 p-0">Email</label>
                             <div class="col-md-12 border-bottom p-0">
                                 <input type="email" class="form-control @error('profile_email') is-invalid @enderror p-2 border-0 mt-3" name="profile_email" id="profile_email" value="" readonly>
                             </div>
                             @error('profile_email')
                             <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            </div>
                         <div class="form-group mb-4">
                            <label for="profile_pic" class="col-md-12 p-0">Profile Pic</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="file" class="form-control @error('image') is-invalid @enderror p-2 border-0 mt-3 image_file" name="image" id="image" >
                            </div>
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                        </div>
                         <div class="form-group mb-4">
                             <label class="col-md-12 p-0">Gender</label>
                             <div class="col-md-12  p-3 d-flex">
                                 <input type="radio" value="M" class="form-check-input p-2 mt-3" name="profile_gender" id="profile_gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Male
                                 </label>
                                 <input type="radio" value="F" class="form-check-input p-2 mt-3 " name="profile_gender" id="profile_gender">
                                 <label class="form-check-label radio_title" for="flexRadioDefault1">
                                     Female
                                 </label>

                             </div>
                         </div>
                         <div class="form-group my-3">
                            <label for="experience" class=" col-md-12 p-0">Experience</label>
                            <div class="input-group col-md-12 border-bottom p-0">
                                <input type="text" class="form-control @error('profile_experience') is-invalid @enderror p-2 border-0 mt-3" name="profile_experience" id="profile_experience" value="" >
                              </div>
                              @error('profile_experience')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="form-group my-3">
                            <label for="designation" class="col-md-12 p-0">Designation</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control @error('profile_designation') is-invalid @enderror p-2 border-0 mt-3" name="profile_designation" id="profile_designation" value="">
                            </div>
                            @error('profile_designation')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                         </div>
                         <div class="form-group my-3">
                            <label for="last_company" class="col-md-12 p-0">Last Company</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control @error('profile_last_company') is-invalid @enderror p-2 border-0 mt-3" name="profile_last_company" id="profile_last_company" value="" >
                            </div>
                            @error('profile_last_company')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                         </div>
                         <div class="form-group mb-4">
                            <label for="profile_address" class="col-md-12 p-0">Address</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control @error('profile_address') is-invalid @enderror p-2 border-0 mt-3" name="profile_address" id="profile_address" value="">
                            </div>
                            @error('profile_address')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                        </div>
                         <div class="form-group my-3">
                             <div class="col-sm-12">
                                 <button type="submit" class="btn btn-success mt-3 updateAdmin" name="updateAdmin" id="updateAdmin">Update Profile</button>
                             </div>
                         </div>
                     </form>
                     
                 </div>
             </div>
        
     </div>
 </div>
</div>

<script>


    </script>



@endsection