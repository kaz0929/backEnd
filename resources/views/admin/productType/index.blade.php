@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="/home/productType/create" class="btn btn-success">新增產品類型</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>types</th>
                <th>sort</th>
                <th width="80"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{$item->types}}</td>
                <td>{{$item->sort}}</td>
                <td>
                    <a href="/home/productType/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                    <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>

                    <form id="delete-form-{{$item->id}}" action="/home/productType/delete/{{$item->id}}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [[ 2, 'desc' ]]
        });
    });

        function show_confirm(id)
        {
            var r=confirm("你確定要刪除嗎!");
            if (r==true)
            {
                //使用者確認刪除
                // document.getElementById('delete-form-'+id).submit();
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
</script>
@endsection
