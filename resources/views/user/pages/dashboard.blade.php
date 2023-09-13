@extends('user.layout.main')

@section('contents')
    <div class="container my-5">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <ul id="myTab" role="tablist"
                            class="nav nav-tabs nav-pills flex-column flex-sm-row text-center rounded-pill bg-light border-0 rounded-nav">
                            <li class="nav-item flex-sm-fill ">
                                <a id="home-tab" data-toggle="tab" href="{{ route('user.dashboard') }}" role="tab" aria-controls="home"
                                    aria-selected="true"
                                    class="nav-link border-0 font-weight-bold {{ Request::is('user/dashboard*') ? 'bg-primary-1 text-white' : 'color-primary-1' }} font-fredoka rounded-pill">Postingan</a>
                            </li>
                            <li class="nav-item flex-sm-fill">
                                <a id="profile-tab" data-toggle="tab" href="{{ route('user.profile') }}" role="tab" aria-controls="profile"
                                    aria-selected="false"
                                    class="nav-link border-0 font-weight-bold {{ Request::is('user/profile*') ? 'bg-primary-1 text-white' : 'color-primary-1' }} font-fredoka rounded-pill">Profil</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

            <h3 class="text-center my-5">Cerita Saya</h3>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1" selected>Terbaru</option>
                        <option value="2">Terpopuler</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1" selected>Aktif</option>
                        <option value="2">Terblokir</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="exampleFormControlInput1" />
                    </div>
                </div>
            </div>

            <div class="row">
                @for ($i = 0; $i < 9; $i++)
                    <div class="col-md-3 col-6 my-3">
                        <x-card.rounded see="123" like="50" title="Yang Terdalam" btn="Detail"
                            img="{{ asset('assets/user/img/lost_home.jpg') }}">
                            Dia pernah ada, rasanya mebekas di sini. Sulit hilang dan mustahil sirna. Antara ada dan
                            tiada...
                        </x-card.rounded>
                    </div>
                @endfor
            </div>
        </div>
    @endsection
