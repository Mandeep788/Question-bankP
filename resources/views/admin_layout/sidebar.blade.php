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
                    <span class="hide-menu">Quizes</span>
                </a>
            </li>
            <li class="sidebar-item pt-3">
                <a class="sidebar-link" href="{{ url('/admin/totalquizblocks') }}" aria-expanded="false">
                    <i class="bi bi-patch-question-fill"></i>
                    <span class="hide-menu">View Quiz Blocks</span>
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
            <div class="notification_bar">
                <div class="d-flex dropdown">
                    <div class="notification">
                        <i class="bi bi-bell-fill" id="bi"></i>
                    </div>
                    <div>
                        <span class="count">
                            <span class="red_circle">

                            </span>
                        </span>
                    </div>
                    <div id="notifications_desc" class="dropdown-content notication_heading">

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
                    <div class="dropdown-content">
                        <a href="{{ url('admin/profile') }}">
                            <button type="button" class="profile_details">Update Profile</button>
                        </a>
                        <a id="logout" style="text-decoration: none;" href="{{ route('logout') }}"><button
                                type="button" class="logout" name="logout">Logout
                            </button>
                        </a>

                </form>
            </div>
        </div>
    </div>
</div>
