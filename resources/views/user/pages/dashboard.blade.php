@extends('layout.main')

@section('content')
    <div class="container my-5">
        <div class="row my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <ul id="myTab" role="tablist"
                            class="nav nav-tabs nav-pills flex-column flex-sm-row text-center rounded-pill bg-light border-0 rounded-nav">
                            <li class="nav-item flex-sm-fill ">
                                <a id="home-tab" data-toggle="tab" href="{{ route('user.dashboard') }}" role="tab"
                                    aria-controls="home" aria-selected="true"
                                    class="nav-link border-0 font-weight-bold {{ Request::is('user/dashboard*') ? 'bg-primary-1 text-white' : 'color-primary-1' }} font-fredoka rounded-pill">Postingan</a>
                            </li>
                            <li class="nav-item flex-sm-fill">
                                <a id="profile-tab" data-toggle="tab" href="{{ route('user.profile') }}" role="tab"
                                    aria-controls="profile" aria-selected="false"
                                    class="nav-link border-0 font-weight-bold {{ Request::is('user/profile*') ? 'bg-primary-1 text-white' : 'color-primary-1' }} font-fredoka rounded-pill">Profil</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

            <h3 class="text-center mt-5">Cerita Saya</h3>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('errorb') }}
                </div>
            @endif
            <div class="container-fluid my-4">
                <div class="row">
                    <a href="{{ route('user.post') }}">
                        <x-button.secondary-green class="col-md-2 col-3">
                            Tulis
                        </x-button.secondary-green>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" id="kagetori">
                        <option value="1" selected>Terbaru</option>
                        <option value="2">Terpopuler</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" id="visibilitas">
                        <option value="1" selected>Aktif</option>
                        <option value="0">Terblokir</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchBar" />
                    </div>
                </div>
            </div>

            <div class="row" id="pad">
                @foreach ($data as $item)
                    <div class="col-md-3 col-6 my-3 d-flex align-items-stretch">
                        <a href="{{ route('user.edit', ['id' => $item->id]) }}">
                            <x-card.rounded see="{{ $item->see }}" like="{{ $item->like }}"
                                title="{{ $item->title }}" btn="Sunting"
                                img="{{ $item->cover ? asset('images/' . $item->cover) : asset('images/lost_home.jpg') }}">
                                <a href="{{ route('user.delete', ['id' => $item->id]) }}">
                                    <x-button.primary-white class="w-100 mt-3">Hapus</x-button.primary-white>
                                </a>
                            </x-card.rounded>

                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let kagetori = 1;
        let visibilitas = 1;
        let cari = null;

        $('#kagetori').on('change', function() {
            kagetori = $(this).val();
            fetchData();
        })
        $('#visibilitas').on('change', function() {
            visibilitas = $(this).val();
            fetchData();
        })
        $('#searchBar').on('input',function(e){
            cari = e.target.value
            if(cari =='' || cari == null ||cari == undefined || cari == ' '){
               fetchData();
            }else{
                searchData();
            }
        })

        function fetchData() {
            $.ajax({
                url: `fetchData/${kagetori}/${visibilitas}`,
                method: "GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // console.log(data.data);
                    let element = "";
                    $.each(data.data, function(index, value) {
                        element += `
                            <div class="col-md-3 col-6 my-3 d-flex align-items-stretch">
                                <a href="edit/${value.id}">
                                    <x-card.rounded see="${value.see}" like="${value.like}" title="${value.title}" btn="Sunting" img="{{ URL::asset('images/${value.cover}') }}">
                                        <a href="delete/${value.id}">
                                            <x-button.primary-white class="w-100 mt-3">Hapus</x-button.primary-white>
                                        </a>
                                    </x-card.rounded>
                                </a>
                            </div>
                        `;
                    })

                    $("#pad").html(element)
                    // console.log(data)
                },
                error: function(error) {
                    console.log(error.message);
                }
            })
        }

        function searchData() {
            $.ajax({
                url: `searchData/${kagetori}/${visibilitas}/${cari}`,
                method: "GET",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // console.log(data.data);
                    let element = "";
                    $.each(data.data, function(index, value) {
                        element += `
                            <div class="col-md-3 col-6 my-3 d-flex align-items-stretch">
                                <a href="edit/${value.id}">
                                    <x-card.rounded see="${value.see}" like="${value.like}" title="${value.title}" btn="Sunting" img="{{ URL::asset('images/${value.cover}') }}">
                                        <a href="delete/${value.id}">
                                            <x-button.primary-white class="w-100 mt-3">Hapus</x-button.primary-white>
                                        </a>
                                    </x-card.rounded>
                                </a>
                            </div>
                        `;
                    })

                    $("#pad").html(element)
                    // console.log(data)
                },
                error: function(error) {
                    console.log(error.message);
                }
            })
        }

    </script>
@endpush
