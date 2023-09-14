<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InnerJoy</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/components/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}">
</head>
<body>
   <section>
        <div class="row w-100">
            <div class="col-md-6 bg-primary-1 d-none d-md-block" style="height: 100vh;">
                <div class="padding-top-140 text-center">
                    <img src="{{ asset('assets/auth/img/contact-us.png') }}" width="450" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12s form">
                <div class="form-login mt-4 mb-5">
                    <div class="text-center text-md-end mb-3">
                        <a class="font-fredoka font-size-40 font-weight-600 color-primary-1" href="#">InnerJoy</a>
                    </div>
                    <form>
                        <div class="mb-2 mb-md-3">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-2 mb-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="mb-2 mb-md-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="mb-4 mb-md-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <x-button.primary-green class="font-size-16 font-weight-600 w-100 mt-0 mt-md-4" onclick="location.href = '/project'">Daftar Sekarang</x-button.primary-green>
                        <h6 class="text-option mt-4">
                            <span>Atau login dengan</span>
                        </h6>
                        <x-button.primary-white class="font-size-16 font-weight-600 color-primary-1 w-100 mt-3" onclick="location.href = '/project'">
                            <img src="{{ asset('assets/auth/img/google-icon.svg') }}" class="me-1" alt="">
                            Google
                        </x-button.primary-white>
                        <div class="font-weight-600 text-center mt-5">Sudah punya akun? <a href="{{ route('login') }}" class="color-primary-1">Masuk Sekarang</a></div>
                    </form>
                </div>
            </div>
        </div>
   </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>