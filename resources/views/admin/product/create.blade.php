@extends('layouts/app')


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <h1>新增產品</h1>
    <form method="POST" action="/home/products/store" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="img">主要圖片上傳</label>
        <input type="file" class="form-control" id="img" name="img" required>
    </div>

    {{-- <div class="form-group">
        <label for="news_imgs">多張圖片上傳</label>
        <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" required multiple>
    </div> --}}

    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" id="exampleFormControlSelect1" name="types_id">
            @foreach ($productTypes as $item)
            <option value="{{$item->id}}">
                {{$item->types}}
            </option>
            @endforeach
        </select>
      </div>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea type="text" class="form-control" id="content" name="content" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{ asset('js/summernote-zh-TW.js') }}"></script>

<script>
    $(document).ready(function() {

        $('#content').summernote({
            height:300,
            lang: 'zh-TW',
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.upload = function (file) {
            let out = new FormData(); //建立一個表單格式
            out.append('file', file, file.name); //將單筆檔案放入表單格式中 append(欄位name, 檔案類型, 檔案名稱)

            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img); //針對你上傳圖片的summertnote執行插入圖片的事件
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });

        };

        $.delete = function (file_link) {

            $.ajax({
                method: 'POST',
                url: '/home/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
    });


</script>
@endsection
