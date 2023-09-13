@extends('admin.layout.main')

@section('contents')
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus fa-beat-fade" style="color: #ffffff;"></i>
        Baru
    </button>
    <div id="dataPad">
    </div>
    {{-- Modal Add --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="form_add">
                        <div class="mb-3">
                            <input type="text" value="" class="d-none" id="idUserProposal">
                            <label for="judulProposal" class="form-label">Judul Proposal</label>
                            <input type="text" class="form-control" id="judulProposal" required>
                        </div>
                        <div class="mb-3">
                            <label for="judulTagline" class="form-label">Tagline</label>
                            <input type="text" class="form-control" id="judulTagline" required>
                            {{-- <small class="text-primary">*opsional</small> --}}
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Pilih Gambar</label>
                            <input class="form-control" type="file" id="photo" multiple required>
                        </div>
                        <div class="mb-3">
                            <label for="pdf" class="form-label">Pilih Proposal</label>
                            <input class="form-control" type="file" id="pdf" required>
                            <small class="text-danger">*harap gunakan format .pdf</small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Detail --}}
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="form_update">
                        <div class="mb-3">
                            <input type="text" value="" class="d-none" id="idProposalDetail">
                            <label for="judulProposal" class="form-label">Judul Proposal Detail</label>
                            <input type="text" class="form-control" id="judulProposalDetail">
                        </div>
                        <div class="mb-3">
                            <label for="judulTagline" class="form-label">Tagline</label>
                            <input type="text" class="form-control" id="judulTaglineDetail">
                            {{-- <small class="text-primary">*opsional</small> --}}
                        </div>
                        <div class="mb-3">
                            <label for="photoProject" class="form-label">Photo</label>
                            <img alt="photo project" id="photoProject" class="img-fluid">
                        </div>
                        <div class="mb-3">
                            <label for="gantiPhotoProject" class="form-label">Ganti Photo</label>
                            <input class="form-control" type="file" id="gantiPhotoProject">
                        </div>
                        <div class="mb-3">
                            <label for="documentProject" class="form-label">Proposal</label>
                            <div id="seeDoc"></div>
                        </div>
                        <div class="mb-3">
                            <label for="gantiDocumentProject" class="form-label">Ganti roposal</label>
                            <input class="form-control" type="file" id="gantiDocumentProject">
                            <small class="text-danger">*harap gunakan format .pdf</small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="descriptionDetail" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateData()" data-bs-dismiss="modal">Ubah</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Confirm Delete --}}
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                  <p>Anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger"  data-bs-dismiss="modal" id="delBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function() {
            getDatas();
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                let formData = new FormData()
                formData.append('id_inventor', $('#idUserProposal').val())
                formData.append('title', $('#judulProposal').val())
                formData.append('tagline', $('#judulTagline').val())
                formData.append('description', $("#description").val())
                formData.append('photo', $('#photo')[0].files[0])
                formData.append('pdf', $('#pdf')[0].files[0])

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
                        alert(data.status);
                        getDatas();
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                })
            })
        })
    </script>
    <script>
        function getDatas() {
            $.ajax({
                url: "",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // console.log(data)
                    let fillHtml = ""
                    fillHtml += "<table id='example' class='display' style='width:100%'>"
                    fillHtml +=
                        "<thead><tr><th>Judul Proposal</th><th>Status</th><th>Pendanaan</th><th>Aksi</th></tr></thead>"
                    fillHtml += "<tbody>"
                    $.each(data.data, function(i, item) {
                        fillHtml += "<tr>"
                        fillHtml += "<td>" + item.title + "</td>"
                        fillHtml += "<td>" + (item.active == 1 ? "<span class='text-primary'>Aktif</span>" : "<span class='text-danger'>Terblokir</span>") + "</td>"
                        fillHtml += "<td>" + (item.open == 1 ? "<span class='text-warning'>Belum</span>" : "<span class='text-success'>Didanai</span>") + "</td>"
                        fillHtml += "<td><button class='btn btn-primary' onclick='showModalDetail(" +
                            JSON.stringify(item) + ")'>Detail</button><button class='btn btn-danger ms-md-3 mt-3 mt-md-0' onclick='confirmDelete(" + item.id + ")'>Hapus</button></td>"
                        fillHtml += "</tr>"
                        // console.log(item)
                    })
                    fillHtml += "</tbody>"
                    fillHtml += "</table>"
                    $("#dataPad").html(fillHtml)
                    new DataTable('#example');
                },
                error: function(error) {
                    // console.log(error)
                }
            });
        }
    </script>
    <script>
        function showModalDetail(item) {
            // console.log(item)
            $("#idProposalDetail").val(item.id)
            $('#judulProposalDetail').val(item.title)
            $('#judulTaglineDetail').val(item.tagline)
            $('#descriptionDetail').val(item.description)
            $('#photoProject').attr('src', `{{ asset('proposals/images/${item.proposal_photo}') }}`)
            $('#seeDoc').html(
                `<a class='btn btn-info' target='_blank' href="{{ asset('proposals/documents/${item.proposal_document}') }}">Lihat</a>`
                )
            $('#exampleModal2').modal('show');
        }
    </script>
    <script>
        function updateData() {
                let formData = new FormData()
                formData.append('id', $('#idProposalDetail').val())
                formData.append('title', $('#judulProposalDetail').val())
                formData.append('tagline', $('#judulTaglineDetail').val())
                formData.append('description', $("#descriptionDetail").val())
                formData.append('photo', $('#gantiPhotoProject')[0].files[0])
                formData.append('pdf', $('#gantiDocumentProject')[0].files[0])

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
                        alert(data.status);
                        getDatas();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            
        }
    </script>
    <script>
        function deleteData(id) {
            // alert(id)
            $.ajax({
                    type: "POST",
                    url: "",
                    data: {id:id},
                    dataType:"json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        alert(data.status);
                        getDatas();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
        }
    </script>
    <script>
        function confirmDelete(id) {
            $('#delBtn').attr('onclick', `deleteData(${id})`)
            $('#exampleModal3').modal('show');
        }
    </script>
@endpush
