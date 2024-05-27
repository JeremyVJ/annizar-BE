<nav class="navbar navbar-header navbar-expand-lg" data-background-color="orange">
				
    <div class="container-fluid">
        <div class="collapse" id="search-nav">
      
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                {{-- <div class="avatar-lg"><img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="image profile" class="avatar-img rounded"></div> --}}
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>