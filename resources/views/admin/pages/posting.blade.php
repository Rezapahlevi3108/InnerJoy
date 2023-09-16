@extends('admin.layout.main')

@section('contents')
    <h2 class="mb-4">Kelola Posting</h2>
    <div class="card bg-white shadow border-0 p-5">
        <div id="postingTable"></div>
    </div>
    
    <!-- modal detail posting-->
    <div class="modal fade" id="ModalDetailPosting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detailPosting"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal detail posting-->

    <!-- Modal Konfirmasi Block -->
    <div class="modal fade" id="ModalBlockConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Blokir Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan memblokir postingan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmBlock" data-bs-dismiss="modal">Blokir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal konfirmasi Block-->

    <!-- Modal Konfirmasi Unblock -->
    <div class="modal fade" id="ModalUnblockConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tampilkan Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menampilkan postingan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmUnblock" data-bs-dismiss="modal">Tampilkan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal konfirmasi Unblock-->

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
                    url: "{{ route('admin.posting.get') }}",
                    success: function(result) {
                        // console.log(result)
                        let fillHtml = ''
                        fillHtml += '<table id="example" class="display" style="width:100%">'
                        fillHtml += '<thead><tr><th>No</th><th>Author</th><th>Judul</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>'
                        fillHtml += '<tbody>'
                        let no = 1
                        $.each(result.data, function(i, item){
                            fillHtml +='<tr>'
                            fillHtml +='<td>'+ no++ +'</td>'
                            fillHtml +='<td>'+ item.user.name +'</td>'
                            fillHtml +='<td>'+ item.title +'</td>'
                            // fillHtml +='<td>'+ item.content +'</td>'
                            let formattedDate = item.created_at.split('T')[0];
                            fillHtml +='<td>'+ formattedDate +'</td>'
                            fillHtml +='<td><span class="' + (item.status ? 'status-green' : 'status-red') + '">' + (item.status ? 'Aktif' : 'Tidak Aktif') + '</span></td>'
                            fillHtml +='<td>';
                            fillHtml +='<div class="d-flex flex-row">';
                            fillHtml +='<button class="btn btn-primary btn-detail-posting me-1" data="'+item.id+'" data-bs-toggle="modal" data-bs-target="#ModalDetailPosting"><i class="fa-solid fa-info" style="color: #ffffff;"></i></button>';
                            fillHtml +='<button class="btn ' + (item.status ? 'btn-danger btn-block' : 'btn-primary btn-unblock') + ' me-1" data="'+item.id+'"><i class="' + (item.status ? 'fa-regular fa-eye-slash' : 'fa-solid fa-eye') + '" style="color: #ffffff;"></i></button>';
                            fillHtml +='<button class="btn btn-danger btn-delete" data="'+item.id+'"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>';
                            fillHtml +='</div>';
                            fillHtml +='</td>';
                            fillHtml +='</tr>'
                        });
                        fillHtml += '</tbody>'
                        fillHtml += '</table>'
            
                        $('#postingTable').html(fillHtml);
                        new DataTable('#example');  
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }

            //Show data
            $(document).on('click', '.btn-detail-posting', function() {
                let id=$(this).attr('data');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.posting.detail-posting', '') }}/" + id,
                    success: function(result) {
                        let fillHtml = ''
                        fillHtml +='<h3 class="text-center font-fredoka mb-5">'+ result.data.title +'</h3>'
                        fillHtml +='<img src="{{ asset('images/') }}' + '/' + result.data.cover + '" class="img-fluid img-posting-cover" alt="Cover Image">'
                        fillHtml +='<p class="mt-5">'+ result.data.content +'</p>'
                        $('#detailPosting').html(fillHtml);
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            // modal konfirmasi block
            $(document).on('click', '.btn-block', function(){
                let id = $(this).attr('data');
                $('#confirmBlock').attr('data-id', id);
                $('#ModalBlockConfirmation').modal('show');
            });

            // Block posting
            $(document).on('click', '#confirmBlock', function(){
                let id = $(this).attr('data-id');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.posting.block', '') }}/" + id,
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

            // modal konfirmasi unblock
            $(document).on('click', '.btn-unblock', function(){
                let id = $(this).attr('data');
                $('#confirmUnblock').attr('data-id', id);
                $('#ModalUnblockConfirmation').modal('show');
            });

            // Unblock posting
            $(document).on('click', '#confirmUnblock', function(){
                let id = $(this).attr('data-id');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.posting.block', '') }}/" + id,
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
                    url: "{{ route('admin.posting.destroy', '') }}/" + id,
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
