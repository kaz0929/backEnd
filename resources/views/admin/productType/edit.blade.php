@extends('layouts/app')

@section('content')

<div class="container">
    <h1>編輯產品類型</h1>

    <form method="POST" action="/home/productType/update/{{$productType->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="types">types</label>
            <input type="text" class="form-control" id="types" name="types" value="{{$productType->types}}">
        </div>
        <div class="form-group">
            <label for="sort">權重(數字越大的排在越前面)</label>
            <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$productType->sort}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
