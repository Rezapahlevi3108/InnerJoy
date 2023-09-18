@extends('admin.layout.main')

@section('contents')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah Admin Aktif</p>
                <h2 class="text-center fw-bold">{{ $dataAdmin }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah User Aktif</p>
                <h2 class="text-center fw-bold">{{ $dataUser }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah Posting</p>
                <h2 class="text-center fw-bold">{{ $dataPosting }}</h2>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah Admin Tidak Aktif</p>
                <h2 class="text-center text-danger fw-bold">{{ $dataAdminNonActive }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah User Tidak Aktif</p>
                <h2 class="text-center text-danger fw-bold">{{ $dataUserNonActive }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 p-3">
                <p class="font-size-18 font-weight-500 text-center">Jumlah Posting Terblokir</p>
                <h2 class="text-center text-danger fw-bold">{{ $dataPostingNonActive }}</h2>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush
