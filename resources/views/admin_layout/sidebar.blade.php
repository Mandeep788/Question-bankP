<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('/img/index.png') }}" alt="logo" width="100px" height="100px"><span><b>Seasia</b> Infotech</span>
    </div>
    <div class="sidebar_menu mt-3">
        <ul id="sidebarnav">
            <!-- User Profile-->
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/dashboard')}}"
                    aria-expanded="false">
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/profile')}}"
                    aria-expanded="false">
                    <span class="hide-menu">User</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/technologies')}}"
                    aria-expanded="false">
                    <span class="hide-menu">Technologies</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="#"
                    aria-expanded="false">
                    <!-- <i class="far fa-clock" aria-hidden="true"></i> -->
                    <span class="hide-menu">Table</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="#"
                    aria-expanded="false">
                    <!-- <i class="far fa-clock" aria-hidden="true"></i> -->
                    <span class="hide-menu">statics</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="#"
                    aria-expanded="false">
                    <!-- <i class="far fa-clock" aria-hidden="true"></i> -->
                    <span class="hide-menu">Add any</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="#"
                    aria-expanded="false">
                    <!-- <i class="far fa-clock" aria-hidden="true"></i> -->
                    <span class="hide-menu">Others</span>
                </a>
            </li>
    </div>
</div>
<div class="main_section">
    <div class="navbar p-4">
            <div class="search">
                <form role="search" class="search_bar">
                    <input type="text" placeholder="Search..." class="form-control mt-0">
                    <a href="#" class="active">
                        <!-- <i class="fa fa-search"></i> -->
                    </a>
                </form>
            </div>
            <div class="dropdown">
                <div class="user_icon">
                    <!-- <a class="profile-pic" href="#"> -->
                        <img src="{{ asset('/img/user.jpg') }}" alt="user-img" width="36" class="img-circle">
                        <div class="text-white font-medium">Ravi Sah</div>
                    <!-- </a> -->
                    <div class="dropdown-content">
                       <a href="{{url('admin/profile')}}"> <button type="button" class="profile_details" >Update Profile</button></a>
                        <button type="button" class="logout" name="logout" ><a id="logout" style="text-decoration: none;" href="{{route('logout')}}">Logout</a>
                        </button>
                </div>
            </div>
        </div>
    </div>
   