<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('/img/index.png') }}" alt="logo" width="100px" height="100px"><b>Seasia</b> Infotech
    </div>
    <div class="sidebar_menu mt-3">
        <ul id="sidebarnav">
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/dashboard')}}"
                    aria-expanded="false">
                    <i class="fa-solid fa-bars-staggered"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/adminprofile')}}"
                    aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/technologies')}}"
                    aria-expanded="false">
                    <i class="fa-solid fa-computer"></i>
                    <span class="hide-menu">Technologies</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{url('admin/users')}}"
                    aria-expanded="false">
                    <i class="fa-solid fa-users"></i>
                    <span class="hide-menu">Users</span>
                </a>
            </li>
    
        </ul>
    </div>
</div>
<div class="main_section">
    <div class="navbar p-4">
            <div class="search mx-5">
                <form role="search" class="search_bar">
                    <div class="search_btn">
                        <div>
                            <input type="text" placeholder="Search..." class="search_input form-control mt-0">
                        </div>
                        <div class="search_icons">
                            <a href="#" class="active">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="dropdown">
                <div class="user_icon">
                    <!-- <a class="profile-pic" href="#"> -->
                        <img src="{{ asset('/img/user.jpg') }}" alt="user-img" width="36" class="img-circle">
                        <div class="text-white font-medium">ravi sah</div>
                    <!-- </a> -->
                    <form action="" method="">
                    <div class="dropdown-content">
                        <a href="{{url('admin/adminprofile')}}">
                        <button type="button" class="profile_details">Update Profile</button>
                    </a>
                   
                        <button type="button" class="logout" name="logout" ><a id="logout" style="text-decoration: none;" href="{{route('logout')}}">Logout</a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
