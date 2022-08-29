<!-- logo and search bar field area----------------- -->
<div class="container-fluid ">
    <div class="row"> 
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">
            <img src= "{{asset('user_img/img/logo2.jpg')}}" class="img">
          </div>
          <div class="col-8"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">

          <div class="col-md-9 COL">
            <form class="d-flex" role="search">

              <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
            </form>
          </div>

          <div class="col-md-3">
            <div class="dropdown">
              <button class=" dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('user_img/img/user.jpg')}}" class="img2"></button>
              <ul class="dropdown-menu shadow">
                <li><a class="dropdown-item" href="{{url('/view_profile')}}"><b>View Profile</b></a></li>
                <li><a class="dropdown-item" href="{{url('/user_edit')}}">Edit Profile</a></li>
                <li><a class="dropdown-item" href="#">Log Out</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

<!--------------------- menu bar section--------------------------- -->
  <div class="container-fluid p-0 justify-content-center ">

    <nav class="navbar navbar-expand-sm shadow navbar-dark  justify-content-center">
      <ul class="navbar-nav justify-content-center">
        <li class="nav-item ">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Php</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Java</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Python</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Javascript</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">GoLang</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">C</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">C++</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" id="h" href="#">.Net</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Html</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">VB.NET</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">More..</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Quizes</a>
        </li>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
      </ul>
    </nav>
  </div>