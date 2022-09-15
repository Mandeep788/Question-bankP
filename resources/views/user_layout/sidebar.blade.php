<!-- logo and search bar field area----------------- -->
<style>
    .sticky {
        position: fixed;
        z-index: 1;
        background-color: #D6D9DC;
        top: 0;
        width: 100%;
    }
</style>
<div class="container-fluid p-0 ">
    <div class="row">
        <div class=" col-md-6 col-sm-4 col-2">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('user_img/img/logo2.jpg') }}" class="img">
                </div>
                <div class="col-8"></div>
            </div>
        </div>
        <div class=" col-md-6 col-sm-8 col-10">
            <div class="row">
                <div class="col-md-4 col-lg-8 col-sm-3 col-2 COL">
                    <input type="text" id="user_id"value="{{Auth::user()->id}}" hidden>


                </div>
                <div class="col-md-4 col-lg-4 col-sm-3 col-2 d-flex div">
                    <i class="fa-regular fa-bell bell py-4" data-bs-toggle="modal" id="notification_value" data-bs-target="#myModal"></i>
                    <span class="count mt-1"></span>
                    <div class="dropdown">
                        <button class=" dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('user_img/img/user.jpg') }}" class="img2"></button>

                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="{{ url('/view_profile') }}"><b>View Profile</b></a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/user_edit') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
                        </ul>
                    </div>
                    <p>{{Auth::user()->name}}</p>

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
                      <input type="text" name="" class="form-control" id="aggregate" val="" aria-describedby="marksHelp" readonly>
                    </div>
                    <div class="m-3">
                        <label for="exampleInputMarks1" class="form-label">Feedback</label>
                        <textarea class="form-control"  id="feedback" cols="10" rows="4" readonly></textarea>
                      </div>


                  </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"  id="close" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    <!--------------------- menu bar section--------------------------- -->
    <div class="container-fluid p-0  justify-content-center  ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="myHeader">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse shadow justify-content-center" id="navbarNav">
                <ul class="navbar-nav justify-content-center  " id="nav-menu">
                    @foreach ($technologies as $items)
                        <li class="nav-item ">
                            <a class="nav-link active " data-id="{{ $items->id }}"
                                href="#">{{ $items->technology_name }}&nbsp; | </a>
                        </li>
                    @endforeach


                </ul>
            </div>
        </nav>
    </div>

    <script>
        $(document).ready(function() {
            $(".btn").click(function() {
                var val = parseInt($('#group').find('.badge').text());

                // Check for the button clicked
                if ($(this).hasClass('btn-danger')) {
                    $('#group').find('.badge').text(val - 1);
                } else if ($(this).hasClass('btn-success')) {
                    $('#group').find('.badge').text(val + 1);
                }
            });
        });


        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
