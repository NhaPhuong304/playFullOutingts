<div class="sidebar">
        <!-- Sidebar -->
        <div class="sidebar-header">
          <img src="{{asset('/admin/assets/images/logo.png')}}" style="width: 80%;">
        </div>
        <div class="sidebar-body  custom-scrollbar">
            <ul class="sidebar-menu">
                <li class="sidebar-label">Main</li>
                 <li><a href="{{url('user/dashboard')}}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i>
                    <p>Home</p>
                </a></li>
                <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><p>Dashboard</p></a></li>
                <li><a href="{{route('admin.game')}}" class="sidebar-link {{ Request::is('admin/game*') ? 'active' : '' }}"><i class="fa-solid fa-gamepad"></i><p>Game</p></a></li>
                <li><a href="{{ route('admin.category') }}" class="sidebar-link {{ Request::is('admin/category*') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></i><p>Category</p></a></li>
                <li><a href="{{route('admin.user')}}" class="sidebar-link {{ Request::is('admin/user*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i><p>Accounts</p></a></li>
                <li><a href="{{route('admin.material')}}" class="sidebar-link {{ Request::is('admin/material*') ? 'active' : '' }}"><i class="fa-solid fa-screwdriver-wrench"></i><p>Material</p></a></li>
                <li><a href="{{route('admin.itineraries')}}" class="sidebar-link {{ Request::is('admin/itineraries*') ? 'active' : '' }}"><i class="fa-regular fa-map"></i><p>Intinerary</p></a></li>
                <li><a href="{{route('admin.locations')}}" class="sidebar-link {{ Request::is('admin/locations*') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i><p>Location</p></a></li>
                 <li>
                    <a href="{{ route('admin.blog.index') }}" class="sidebar-link">
                        <i class="fa-solid fa-blog"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                <li><a href="#" class="sidebar-link submenu-parent"><i class="bi bi-trash"></i><p>Trash <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{route('admin.trashItineraries')}}" class="submenu-link {{ Request::is('admin/trashItineraries*') ? 'active' : '' }}"><i class="fa-regular fa-map"></i><p>Itinerary</p></a></li>
                        <li><a href="{{route('admin.trashCategory')}}" class="submenu-link {{ Request::is('admin/trashCategory*') ? 'active' : '' }}"><i class="fa-solid fa-list"></i><p>Category</p></a></li>
                        <li><a href="{{route('admin.trashGame')}}" class="submenu-link {{ Request::is('admin/trashGame*') ? 'active' : '' }}"><i class="fa-solid fa-gamepad"></i><p>Game</p></a></li>
                    </ul>
                </li>
            </ul>
        </div>
</div>