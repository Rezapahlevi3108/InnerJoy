<nav class="navbar navbar-expand-lg bg-transparant fixed-top">
    <div class="container">
        <a class="navbar-brand font-fredoka font-size-30 font-weight-600 color-primary-1" href="{{ route('landing.index') }}">InnerJoy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto text-center">
                <a class="nav-link font-size-18 font-weight-400 me-md-4" href="{{ route('beranda') }}">Beranda</a>
                <a class="nav-link font-size-18 font-weight-400 me-md-4" href="#">Tentang</a>
                <a class="nav-link font-size-18 font-weight-400" href="#">Kontak</a>
            </div>
            @if (Auth::check())
            <div class="collapse navbar-collapse  justify-content-end" id="navbarNavDarkDropdown">
              <ul class="navbar-nav ">
                <li class="nav-item dropdown ">
                  <button class="btn btn-dark dropdown-toggle bg-primary-1 border border-0" data-bs-toggle="dropdown" aria-expanded="false">
                   Halo, {{Auth::user()->name}}
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark bg-primary-1">
                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Beranda</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            @else
            <x-button.secondary-green class="font-size-12 font-weight-400 d-block mx-auto mx-md-2 me-md-2 mb-2 mb-md-0" onclick="location.href = '{{ route('login') }}'">Login</x-button.secondary-green>
            <x-button.secondary-green class="font-size-12 font-weight-400 d-block mx-auto mx-md-0" onclick="location.href = '{{ route('register') }}'">Register</x-button.secondary-green>
            @endif
        </div>
    </div>
</nav>

<script>
    var nav = document.querySelector('nav');
    window.addEventListener('scroll', function () {
      if(window.pageYOffset > 50) {
        nav.classList.add('bg-white', 'shadow');
      }else{
        nav.classList.remove('bg-white', 'shadow', );
      }
    });
</script>