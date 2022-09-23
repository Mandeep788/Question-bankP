<!-- logo and search bar field area----------------- -->
<div class="container-fluid p-0 ">
    <div class="row">
        <div class=" col-md-6 col-sm-4 col-2">
            <div class="row">
                <div class="col-md-4">
                   <a  href="{{url("/dashboard")}}"> <img src="{{ asset('user_img/img/download.png') }}" class="img"></a>
                </div>
                <div class="col-8"></div>
            </div>
        </div>
        <div class=" col-md-6 col-sm-8 col-10">
            <div class="row">
                <div class="col-md-4 col-lg-8 col-sm-3 col-2 COL">
                    <input type="text" id="user_id"value="{{ Auth::user()->id }}" hidden>
                    <div class="socialMedia">
                    <i class="bi bi-instagram ml-4"></i>
                    <i class="bi bi-facebook ml-4"></i>
                    <i class="bi bi-twitter ml-4"></i>
                    <i class="bi bi-youtube"></i>
                    </div>


                </div>
                <div class="col-md-4 col-lg-4 col-sm-3 col-2 d-flex div">
                    <i class="fa-regular fa-bell bell py-5" id="notification_value"></i>
                    <span class="count"></span>
                    <div class="dropdown">
                        <button class=" dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('user_img/img/user.jpg') }}" class="img2"></button>

                            <div class="notification">
                                <p>test</p>
                            </div>

                            <p>{{Auth::user()->name}}</p>

                        <b><p class="username">{{ Auth::user()->name }}</p></b>


                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="{{ url('/view_profile') }}"><b>View Profile</b></a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/user_edit') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/notificationPanel') }} " >Notificatons</a></li>
                            <li><a class="dropdown-item" href=" " id="logout">Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->

                <div class="modal-header">
                    <h5 class="modal-title">Quiz Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body " id="notification" style="font-size:15px;">
                </div>

            </div>
        </div>
    </div>
    {{-- check status result modal------------------------------------ --}}
    <div class="modal fade" id="check_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                </div>
                <form>
                    <div class="m-3">
                        <label for="exampleInputMarks1" class="form-label">Marks</label>
                        <input type="text" name="" class="form-control" id="aggregate" val=""
                            aria-describedby="marksHelp" readonly>
                    </div>
                    <div class="m-3">
                        <label for="exampleInputMarks1" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" cols="10" rows="4" readonly></textarea>
                    </div>


                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--------------------- menu bar section--------------------------- -->
    <div class="container-fluid p-0  justify-content-center " id="topheader">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="myHeader">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse shadow justify-content-center" id="navbarNav">
                <ul class="navbar-nav justify-content-center" id="nav-menu">

                    @foreach ($technologies as $items)
                    {{-- <li class="active"></li> --}}
                        <li class="nav-item" >
                            <a class=" nav-link" data-id="{{ $items->id }}"
                                href="#">{{ $items->technology_name }}&nbsp; | </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </nav>
    </div>
    <script>



    </script>
