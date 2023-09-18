@extends('layout.main')

@section('content')
    <div class="container my-5">
        <div class="row">
            <h3 class="text-center">Edit Post</h3>
            <form action="{{ route('user.storeEditPost') }}" class="text-center" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" value="{{$data->id}}" class="d-none">
                <img src="{{ asset('images/'.$data->cover) }}" id="preview" style="object-fit: cover;height:400px;width:100%;" class="img-fluid" alt="cover-bg">
                <div class="my-5">
                    <x-button.primary-green id="trigger">
                        Pilih Gambar Cover
                    </x-button.primary-green>
                    <input class="form-control d-none" type="file" id="file" name="file">
                </div>
                <div class="mb-3 text-start">
                    <label for="judulArtikel" class="form-label">Judul Artikel</label>
                    <input type="text" class="form-control" id="judulArtikel" name="title" value="{{$data->title}}">
                </div>
                <div class="mb-3 text-start">
                    <label for="isiArtikel" class="form-label">Isi Artikel</label>
                    <textarea class="form-control my-editor" id="isiArtikel" rows="20" name="content" >
                        {{$data->content}}
                    </textarea>
                </div>
                <div class="mb-3 text-start">
                    <x-button.primary-green type="submit">
                        Posting
                    </x-button.primary-green>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
     $("#trigger").click(function(e) {
            e.preventDefault();
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
    <script src="https://cdn.tiny.cloud/1/ocoha1ew50mg21qxmdnslsqi8c51eqxpqqyrp4q0vmduv7wp/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
     var editor_config = {
      path_absolute : "/",
      selector: 'textarea.my-editor',
      relative_urls: false,
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }
  
        tinyMCE.activeEditor.windowManager.openUrl({
          url : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    };
  
    tinymce.init(editor_config);
    </script>
@endpush
