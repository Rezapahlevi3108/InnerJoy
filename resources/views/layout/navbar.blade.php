<nav class="navbar navbar-expand-lg bg-transparant fixed-top">
    <div class="container">
        <a class="navbar-brand font-fredoka font-size-30 font-weight-600 color-primary-1" href="#">InnerJoy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto text-center">
                <a class="nav-link font-size-18 font-weight-400 me-md-4" href="#">Beranda</a>
                <a class="nav-link font-size-18 font-weight-400 me-md-4" href="#">Tentang</a>
                <a class="nav-link font-size-18 font-weight-400" href="#">Kontak</a>
            </div>
            <x-button.secondary-green class="font-size-12 font-weight-400 d-block mx-auto mx-md-2 me-md-2 mb-2 mb-md-0" onclick="location.href = '{{ route('login') }}'">Login</x-button.secondary-green>
            <x-button.secondary-green class="font-size-12 font-weight-400 d-block mx-auto mx-md-0" onclick="location.href = '{{ route('register') }}'">Register</x-button.secondary-green>
        </div>
    </div>
</nav>

<script>
    var nav = document.querySelector('nav');
    window.addEventListener('scroll', function () {
      if(window.pageYOffset > 100) {
        nav.classList.add('bg-white', 'shadow');
      }else{
        nav.classList.remove('bg-white', 'shadow', );
      }
    });
</script>