@extends('layouts/app')


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <h1>新增產品類型</h1>
    <form method="POST" action="/home/productType/store" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="types">types</label>
      <input type="text" class="form-control" id="types" name="types" required>
    </div>

    <div class="form-group">
      <label for="Sort">Sort</label>
      <input type="text" class="form-control" id="Sort" name="Sort" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
