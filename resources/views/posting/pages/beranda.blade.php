@extends('layout.main')

@section('content')
    <div class="my-5 pt-5">
        <h1 class="font-size-30 font-weight-600 color-primary-2 text-center mb-5">Beranda</h1>
        @for ($i = 0; $i < 9; $i++)
        <div class="border border-2 border-start-0 border-end-0 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <a href="">
                            <div class="d-flex">
                                <img src="{{ asset('assets/user/img/cover.jpg') }}" class="rounded d-none d-md-block me-4" width="300" alt="story-image">
                                <div>
                                    <h1 class="font-size-25 font-weight-500">Yang Terdalam</h1>
                                    <p class="font-size-14 font-weight-400">Sepi dan sangat sunyi. Senyuman itu sudah tidak lagi sama seperti terakhir bertemu. Dingin, kehangatan itu telah hilang sejak lama. Tajam, rasaku seperti ingin diterkam kesunyian diri. Aku kira sudah akan datang, dia yang membawa kencana hitam dari sana tidak kunjung datang juga....</p>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center me-3">
                                            <i class="fa-solid fa-eye me-1"></i>
                                            <span class="font-size-12">200</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-heart me-1" style="color: #e64c4c;"></i>
                                            <span class="font-size-12">50</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <div class="d-md-flex align-items-center justify-content-end font-size-12 font-weight-400 mt-3 mt-md-0 text-end">
                            <i class="fa-solid fa-calendar-days me-2"></i>
                            <span>17 Juli 2023</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
@endsection
