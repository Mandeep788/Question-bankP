<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('/img/index.png') }}" alt="logo" width="100px" height="100px"><b>Seasia</b> Infotech
    </div>
    <div class="sidebar_menu mt-3">
        <ul id="sidebarnav">
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('admin/dashboard') }}" aria-expanded="false">
                    <i class="fa-solid fa-bars-staggered"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item pt-3">
                <a id="admin_profile" class="sidebar-link" href="{{ url('admin/profile') }}" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('admin/technologies') }}" aria-expanded="false">
                    <i class="fa-solid fa-computer"></i>
                    <span class="hide-menu">Technologies</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/users') }}" aria-expanded="false">
                    <i class="fa-solid fa-users"></i>
                    <span class="hide-menu">Users</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/quiz') }}" aria-expanded="false">
                    <i class="bi bi-patch-question-fill"></i>
                    <span class="hide-menu">Quizzes</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/indexblock') }}" aria-expanded="false">
                    <i class="bi bi-archive-fill"></i>
                    <span class="hide-menu">View Quiz Blocks</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/indexNotification') }}" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="hide-menu">Test Info</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main_section">
    <div class="navbar p-3">
        <div class=" d-flex">
            <div class="heading">
                <h4>Admin Panel</h4>
            </div>
            <div class="notification_bar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="d-flex dropdownn">
                    <div class="notification">
                        <i class="bi bi-bell-fill" id="bi"></i>
                    </div>
                    <div>
                        <span class="count">
                            <span class="red_circle">
                            </span>
                        </span>
                    </div>
                    {{-- <div id="notifications_desc" class="dropdown-content notication_heading" >

                    </div> --}}
                    <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button> --}}
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 91px; margin-left: -123px; width: 75%; ">
                <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Notifications</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body" id="notifications_desc" class="dropdown-content notication_heading">
                {{-- <hr> --}}
                </div>
                {{-- <hr> --}}
                {{-- <div class="modal-footer p-4"> --}}
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
                {{-- </div> --}}
            </div>
            </div>
        </div>
                </div>
            </div>
        </div>


        <div class="dropdown">
            <div class="user_icon">
                <div class="profile">
                    <img src="{{ Auth::user()->image }}" alt="user-img" width="40" height="35px"
                        class="img_circle">
                </div>
                <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                <form action="" method="">
                    <div class="dropdown-menu">
                        <a href="{{ url('admin/profile') }}">
                            <button type="button" class="profile_details">Update Profile</button>
                        </a>
                        <a id="logout" style="text-decoration: none;" ><button
                                type="button" class="logout" name="logout">Logout
                            </button>
                        </a>

                </form>
            </div>
        </div>
    </div>
</div>
