@extends('layouts/app')

@section('content')

<div class="container">
    <h1>編輯最新消息</h1>

    <form method="POST" action="/home/news/update/{{$news->id}}">
    @csrf
    <div class="form-group">
        <label for="img">IMG</label>
        <input type="text" class="form-control" id="img" name="img" value="{{$news->img}}">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
