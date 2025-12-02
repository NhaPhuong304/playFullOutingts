<div class="header-overlay"></div>
    <div class="header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="menu-toggle me-3 d-block d-lg-none text-color-1"><span><i class="fa-solid fa-bars font-size-24"></i></span></div>
            <div class="collapse-sidebar me-3 d-none d-lg-block text-color-1"><span><i class="fa-solid font-size-24 fa-bars"></i></span></div>
            <div><h1 class="page-title">@yield('page-title', 'Dashboard')</h1></div>
        </div>
        <div class="d-flex align-items-center">
            <div class="d-none d-md-block d-lg-block me-4">
            </div>
            <ul class="nav d-flex align-items-center">
                <!-- Messages Dropdown -->
                <li class="nav-item me-2">
                    <a href="#" class="text-color-1 position-relative header-nav-item"  role="button" 
                        data-bs-toggle="dropdown" 
                        data-bs-offset="0,0" 
                        aria-expanded="false">
                        <i class="fa-solid fa-envelope fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mt-3">
                        <div id="chatmessage" class="h-380 scroll-y p-3 custom-scrollbar">
                            <!-- Chat Timeline -->
                            <ul class="timeline">
                                <!-- Item 1 -->
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/avatar-1.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">We talked about a project...</h6>
                                            <small class="d-block"><i class="fa-solid fa-clock"></i> 30 min ago</small>
                                        </div>
                                    </div>
                                </li>
                                <!-- Item 2 -->
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/avatar-2.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">You sent an email to the client...</h6>
                                            <small class="d-block"><i class="fa-solid fa-clock"></i> 1 hour ago</small>
                                        </div>
                                    </div>
                                </li>
                                <!-- Item 3 -->
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/avatar-3.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Meeting with the design team...</h6>
                                            <small class="d-block"><i class="fa-solid fa-clock"></i> 2 hours ago</small>
                                        </div>
                                    </div>
                                </li>
                                <!-- Item 4 -->
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/avatar-4.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Reviewed the project documents...</h6>
                                            <small class="d-block"><i class="fa-solid fa-clock"></i> Yesterday</small>
                                        </div>
                                    </div>
                                </li>
                                <!-- Item 5 -->
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/avatar-5.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Finalized the project timeline...</h6>
                                            <small class="d-block"><i class="fa-solid fa-clock"></i> 2 days ago</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a class="all-notification" href="#">See all message <i class="fas fa-arrow-right"></i></a>
                    </div>
                </li>
                <!-- Notifications Dropdown -->
                <li class="nav-item me-2">
                    <a href="#" class="text-color-1 notification header-nav-item" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        data-bs-offset="0,0" 
                        aria-expanded="false">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mt-3">
                        <div id="Notification" class="h-380 scroll-y p-3 custom-scrollbar">
                            <!-- Notifications Timeline -->
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/profile.png">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Dr Smith uploaded a new report</h6>
                                            <small class="d-block">10 December 2023 - 08:15 AM</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-info">
                                            AP
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">New Appointment Scheduled</h6>
                                            <small class="d-block">10 December 2023 - 09:45 AM</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-success">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Patient checked in at reception</h6>
                                            <small class="d-block">10 December 2023 - 10:20 AM</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="./assets/images/profile.png">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Dr Alice shared a prescription</h6>
                                            <small class="d-block">10 December 2023 - 11:00 AM</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-danger">
                                            EM
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Emergency Alert: Critical Patient</h6>
                                            <small class="d-block">10 December 2023 - 11:30 AM</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-primary">
                                            <i class="fa fa-calendar-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">Next Appointment Reminder</h6>
                                            <small class="d-block">10 December 2023 - 12:00 PM</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                        </div>
                        <a class="all-notification" href="#">See all notifications <i class="fas fa-arrow-right"></i></a>
                    </div>
                </li>
                <li class="nav-item me-2" id="themeToggle">
                    <span class="header-nav-item sun-icon">
                        <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="moon-icon header-nav-item d-none">
                        <svg fill="currentColor" width="20px" height="20px"  viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </span>
                </li>
                <!-- User Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user() && Auth::user()->photo ? asset('storage/avatars/' . Auth::user()->photo) : asset('images/no_image.jpg') }}" 
                            class="user-avatar rounded-circle" alt="avatar" width="40">



                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><h6 class="dropdown-header">Settings</h6></li>
                            <li><a class="dropdown-item" href="{{ route('admin.profile', auth()->user()->id) }}"><i class="fa-regular fa-user"></i> Profile Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-regular fa-bell"></i> Notifications</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-shield-halved"></i> Privacy &amp; Security</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-regular fa-credit-card"></i> Billing</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

            </ul>
        </div>
    </div>