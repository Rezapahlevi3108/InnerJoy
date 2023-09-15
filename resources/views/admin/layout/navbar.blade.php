 <!-- Top navigation-->
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary bg-transparent border border-0 text-black" id="sidebarToggle"> 
            <i class="fa-solid fa-bars"></i>    
        </button>
        
        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="profileName" class="text-truncate">{{Auth::user()->name}}</span>
                    <img height="25" width="25" class="rounded-circle" src="{{ $user->UserDetail->profile_photo ? asset('profile/' . $user->UserDetail->profile_photo) : asset('assets/admin/img/profile.svg') }}" alt="admin-pp">
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>