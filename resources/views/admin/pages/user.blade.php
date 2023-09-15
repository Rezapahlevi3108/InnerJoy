@extends('admin.layout.main')

@section('contents')
    <div class="card bg-white shadow p-5">
        <div class="ms-auto mb-3">
            <x-button.primary-green type="button" class="font-size-14" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                <i class="fa-solid fa-plus fa-beat-fade me-2" style="color: #ffffff;"></i>
                Tambah Data
            </x-button.primary-green>
        </div>
    
        <div id="userTable"></div>
    </div>
    
    <!-- modal tambah-->
    <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="text" class="form-control" id="password">
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="active" name="active">
                            <label class="form-check-label" for="active">Aktif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="save" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal tambah-->
    
    <!-- modal edit-->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group d-none">
                            <label>ID</label>
                            <input type="text" class="form-control" id="idEdit" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nameEdit">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="emailEdit">
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="activeEdit" name="activeEdit">
                            <label class="form-check-label" for="activeEdit">Aktif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="update">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal edit-->
    
    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="ModalDeleteConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete" data-bs-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal konfirmasi delete-->
@endsection

@push('custom-script')
    <script>
        $(document).ready(function() {

            getData()
            
            // Get data
            function getData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.user.get') }}",
                    success: function(result) {
                        // console.log(result)
                        let fillHtml = ''
                        fillHtml += '<table id="example" class="display" style="width:100%">'
                        fillHtml += '<thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr></thead>'
                        fillHtml += '<tbody>'
                        let no = 1
                        $.each(result.data, function(i, item){
                            fillHtml +='<tr>'
                            fillHtml +='<td>'+ no++ +'</td>'
                            fillHtml +='<td>'+ item.name +'</td>'
                            fillHtml +='<td>'+ item.email +'</td>'
                            fillHtml +='<td>'+ item.role +'</td>'
                            fillHtml +='<td><span class="' + (item.active ? 'status-green' : 'status-red') + '">' + (item.active ? 'Aktif' : 'Tidak Aktif') + '</span></td>'
                            fillHtml +='<td><button class="btn btn-primary btn-edit" data="'+item.id+'" data-bs-toggle="modal" data-bs-target="#ModalEdit">Edit</button> <button class="btn btn-danger btn-delete" data="'+item.id+'">Hapus</button></td>'
                            fillHtml +='</tr>'
                        });
                        fillHtml += '</tbody>'
                        fillHtml += '</table>'
            
                        $('#userTable').html(fillHtml);
                        new DataTable('#example');  
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }

            function clearForm() {
                $('#name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#active').prop('checked', false);
                $('#premium').prop('checked', false);
            }

            //Create data
            $('#save').click(function(){
                let name=$('#name').val();
                let email=$('#email').val();
                let password=$('#password').val();
                let active=$('#active').prop('checked') ? 1 : 0;
                
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.user.store') }}",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        active: active,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert(result.status);
                        getData();
                        clearForm();
                    },
                    error: function(error) {
                        alert(error)
                    }
                });
            });

            //Show data
            $(document).on('click', '.btn-edit', function() {
                let id=$(this).attr('data');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.user.show', '') }}/" + id,
                    success: function(result) {
                        $('#idEdit').val(result.data.id);
                        $('#nameEdit').val(result.data.name);
                        $('#emailEdit').val(result.data.email);
                        $('#activeEdit').prop('checked', result.data.active);
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            // update
            $('#update').click(function(){
                let id=$('#idEdit').val();
                let name=$('#nameEdit').val();
                let email=$('#emailEdit').val();
                let active=$('#activeEdit').prop('checked') ? 1 : 0;
                let json = {"id" : id, "name" : name, "email" : email, "active" : active};
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.user.update', '') }}/" + id,
                    contentType: 'application/json',
                    data: JSON.stringify(json),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        alert(result.status);
                        getData();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // modal konfirmasi delete
            $(document).on('click', '.btn-delete', function(){
                let id = $(this).attr('data');
                $('#confirmDelete').attr('data-id', id);
                $('#ModalDeleteConfirmation').modal('show');
            });

            // delete data
            $(document).on('click', '#confirmDelete', function(){
                let id = $(this).attr('data-id');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.user.destroy', '') }}/" + id,
                    success: function(result) {
                        alert(result.status);
                        getData();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
