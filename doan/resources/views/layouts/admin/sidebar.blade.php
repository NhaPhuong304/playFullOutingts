<div class="sidebar">
        <!-- Sidebar -->
        <div class="sidebar-header">
            <div class="lg-logo"><a href="index.html"><img src="{{asset('admin/assets/images/image.png')}}" class="large-logo-img" alt="logo large"></a></div>
            <div class="sm-logo"><a href="index.html"><img src="{{asset('admin/assets/images/image.png')}}" class="small-logo-img" alt="logo small"></a></div>
        </div>
        <div class="sidebar-body  custom-scrollbar">
            <ul class="sidebar-menu">
                <li class="sidebar-label">Main</li>
                <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><p>Dashboard</p></a></li>
                <li><a href="{{route('admin.game')}}" class="sidebar-link {{ Request::is('admin/game*') ? 'active' : '' }}"><i class="fa-solid fa-box"></i><p>Game</p></a></li>
                <li><a href="{{ route('admin.category') }}" class="sidebar-link {{ Request::is('admin/category*') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></i><p>Category</p></a></li>
                <li><a href="{{route('admin.user')}}" class="sidebar-link {{ Request::is('admin/user*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i><p>User</p></a></li>
                <li><a href="analytics.html" class="sidebar-link"><i class="fa-regular fa-chart-bar"></i><p>Analytics</p></a></li>
                <li><a href="setting.html" class="sidebar-link"><i class="fa-regular fa-gear"></i><p>Setting</p></a></li>
                <li><a href="profile.html" class="sidebar-link"><i class="fa-regular fa-user"></i><p>Profile</p></a></li>
                <li><a href="#" class="sidebar-link submenu-parent"><i class="bi bi-trash"></i><p>Trash <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('admin.trashUser')}}" class="submenu-link {{ Request::is('admin/trashUser*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i></i><p>User</p></a></li>
                        <li><a href="{{route('admin.trashCategory')}}" class="submenu-link {{ Request::is('admin/trashCategory*') ? 'active' : '' }}"><i class="fa-solid fa-list"></i><p>Category</p></a></li>
                        <li><a href="forgot-password.html" class="submenu-link"><i class="fa-solid fa-recycle"></i><p>Forgot password</p></a></li>
                    </ul>
                </li>
                <li><a href="#" class="sidebar-link submenu-parent"><i class="fa-solid fa-list"></i><p>Pages <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                    <ul class="sidebar-submenu">
                        <li><a href="login.html" class="submenu-link"><i class="fa-solid fa-fingerprint"></i><p>Login</p></a></li>
                        <li><a href="signup.html" class="submenu-link"><i class="fa-solid fa-user-plus"></i><p>Register</p></a></li>
                        <li><a href="forgot-password.html" class="submenu-link"><i class="fa-solid fa-recycle"></i><p>Forgot password</p></a></li>
                    </ul>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-link btn btn-link p-0 d-flex align-items-center">
                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                            <p class="m-0">Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
</div>