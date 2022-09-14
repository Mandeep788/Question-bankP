@extends('admin_layout.template')
@section('main-content')

            <div class="first_section">
                <div class="bg-white">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h5 class="page-title p-3">Profile</h5>
                        </div>
                        
                    </div>
                </div>
            </div>    
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="profile_box">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <a href=""><img src="{{ asset('/img/user.jpg') }}"
                                            class="user_profile" alt="img"></a>
                                    <h4 class="user_name mt-4">Ravi Sah</h4>
                                    <h5 class="user_mail">ravisah1@gmail.com</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card" id="white_box">
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Ravi Sah"
                                                class="form-control p-0 border-0 mt-3" name="name" id="email"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="ravisah1@gmail.com"
                                                class="form-control p-0 border-0 mt-3" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="password" class="form-control p-0 border-0 mt-3" name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No.</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="123 456 7890"
                                                class="form-control p-0 border-0 mt-3" name="phone_no" id="phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Date of Birth</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="123 456 7890"
                                                class="form-control p-0 border-0 mt-3" name="phone_no" id="phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Language Known</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="5" class="form-control p-0 border-0 mt-3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Message</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="5" class="form-control p-0 border-0 mt-3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Select Country</label>

                                        <div class="col-sm-12 border-bottom">
                                            <select class="form-select shadow-none p-0 border-0 form-control-line mt-3">
                                                <option>Korea</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Nepal</option>
                                                <option>Japan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success mt-3">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

  @endsection      