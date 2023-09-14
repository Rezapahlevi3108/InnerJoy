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

            <h3 class="text-center my-5">Profil Saya</h3>
            <div class="row">
                <div class="">
                    <form id="form" enctype="multipart/form-data" method="POST">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="text" value="" class="d-none" id="id_user">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/admin/img/profile.svg') }}" id="preview" class="rounded-3"
                                height="100px" width="100px" alt="photo_profil" style="object-fit: cover">
                            <button class="btn btn-primary btn-user m-3" type="button" id="trigger">Pilih</button>
                            <input type="file" name="file" id="file" class="d-none">
                        </div>
                        <div class="mt-5">
                            <div class="form-group mb-3">
                                <label for="namaLengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namaLengkap" name="name"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="org">Universitas</label>
                                <input type="text" class="form-control" id="org" name="org"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" >
                                
                            </textarea>
                            </div>
                            <small class="text-danger">*semus field WAJIB DIISI!</small>
                            <div class="form-group mb-3">
                                <x-button.primary-green>
                                    Simpan
                                </x-button.primary-green>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('custom-script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $("#trigger").click(function() {
            $("#file").trigger('click');
        })

        $("#file").change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#preview").attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            $("#send").click(function() {
                let fileUpload = $('#file').prop('files')[0];
                let formData = new FormData()
                formData.append('file', fileUpload);
                formData.append('id', $("#id_user").val());
                formData.append('name', $("#namaLengkap").val());
                formData.append('email', $("#email").val());
                formData.append('phone', $("#telepon").val());
                formData.append('nik', $("#nik").val());
                formData.append('org', $("#org").val());
                formData.append('linkedin', $("#linkedin").val());
                formData.append('address', $("#alamat").val());

                $.ajax({
                    type: "POST",
                    url: "",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        alert(data.status)
                        console.log(data)
                        let emelemnt = ""
                        element += "<span class='text-truncate'>"+$("#namaLengkap").val()+"</span>"
                        $('#profileName').html(element)
                    },
                    error: function(error) {
                        alert(error)
                        console.log(error)
                    }
                })
            })
        })
    </script>
@endpush
