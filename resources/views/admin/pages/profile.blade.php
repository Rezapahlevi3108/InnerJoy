@extends('admin.layout.main')

@section('contents')
    <h5>Halaman Profil</h5>
    <div class="card bg-white shadow p-5">
        <form id="form" enctype="multipart/form-data" method="POST">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="text" value="" class="d-none" id="id_user">
            <div class="d-flex align-items-center">
                <img src="{{ $user->UserDetail->profile_photo ? asset('profile/' . $user->UserDetail->profile_photo) : asset('assets/admin/img/profile.svg') }}" id="preview" class="rounded" height="100px" width="100px" alt="photo_profil" style="object-fit: cover">
                <x-button.primary-green type="button" class="font-size-14 m-3" id="trigger">Pilih</x-button.primary-green>
                <input type="file" name="file" id="file" class="d-none">
            </div>
            <div class="mt-5">
                <div class="form-group mb-3">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" name="name" value="{{ $user->name ? $user->name : '' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ? $user->email : '' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $user->UserDetail->phone ? $user->UserDetail->phone : '' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $user->UserDetail->address ? $user->UserDetail->address : '' }}</textarea>
                </div>
                <small class="text-danger">*Semua field WAJIB DIISI!</small>
                <div class="form-group mb-3">
                    <x-button.primary-green type="button" id="send">
                        Simpan
                    </x-button.primary-green>
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
                formData.append('address', $("#alamat").val());

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.profileUpdate') }}",
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