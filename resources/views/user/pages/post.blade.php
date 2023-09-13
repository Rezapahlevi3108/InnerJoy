@extends('user.layout.main')

@section('contents')
    <div class="container my-5">
        <div class="row">
            <h1 class="text-center">post</h1>
            <form action="#" class="text-center">
                <img src="{{ asset('assets/user/img/cover.jpg') }}" class="img-fluid" alt="cover-bg">
                <div class="my-5">
                    <x-button.primary-green>
                        Pilih Gambar Cover
                    </x-button.primary-green>
                    <input class="form-control d-none" type="file" id="formFile">
                </div>
                <div class="mb-3 text-start">
                    <label for="judulArtikel" class="form-label">Judul Artikel</label>
                    <input type="text" class="form-control" id="judulArtikel">
                </div>
                <div class="mb-3 text-start">
                    <label for="isiArtikel" class="form-label">Isi Artikel</label>
                    <textarea class="form-control my-editor" id="isiArtikel" rows="20"></textarea>
                </div>
                <div class="mb-3 text-start">
                    <x-button.primary-green>
                        Posting
                    </x-button.primary-green>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-script')
    <script src="https://cdn.tiny.cloud/1/ocoha1ew50mg21qxmdnslsqi8c51eqxpqqyrp4q0vmduv7wp/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.my-editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endpush
