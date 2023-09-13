@extends('user.layout.main')

@section('contents')
    <div class="container my-3">
        <div class="row">
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
                    <x-card.rounded see="123" like="50" title="Yang Terdalam" btn="Detail" img="{{ asset('assets/user/img/lost_home.jpg') }}">
                     Dia pernah ada, rasanya mebekas di sini. Sulit hilang dan mustahil sirna. Antara ada dan
                     tiada...
                     </x-card.rounded>
                 </div>
                @endfor
            </div>
        </div>
    @endsection
