@extends('admin.layout.main')

@section('contents')
    <h5>Halaman Profil</h5>
    <div class="">
        <form id="form" enctype="multipart/form-data" method="POST">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="text" value="" class="d-none" id="id_user">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/admin/img/profile.svg') }}" id="preview" class="rounded"
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
                    <button type="button" class="btn btn-primary" id="send">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('custom-script')
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