@extends('layouts/nav')

@section('css')
<style>
    .Cart {
        margin: 50px auto;
    }

    .Cart__header {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__headerGrid {
        text-align: center;
        background: #f3f3f3;
    }

    .Cart__product {
        display: grid;
        grid-template-columns: 2fr 7fr 3fr 3fr 3fr 3fr;
        grid-gap: 2px;
        margin-bottom: 2px;
        height: 90px;
    }

    .Cart__productGrid {
        padding: 5px;
    }

    .Cart__productImg {
        background-image: url(https://fakeimg.pl/640x480/c0cfe8/?text=Img);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .Cart__productTitle {
        overflow: hidden;
        line-height: 25px;
    }

    .Cart__productPrice,
    .Cart__productQuantity,
    .Cart__productTotal,
    .Cart__productDel {
        text-align: center;
        line-height: 60px;
    }

    .btn-minus , .btn-plus , .btn-delete{
        padding:2px 4px;
    }

    @media screen and (max-width: 820px) {
        .Cart__header {
            display: none;
        }

        .Cart__product {
            box-shadow: 2px 2px 3px 0 rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 2fr 2fr 2fr 2fr 2fr 2fr 1fr;
            grid-template-areas:
                "img title title title title title del"
                "img price price quantity total total del";
        }

        .Cart__productImg {
            grid-area: img;
        }

        .Cart__productTitle {
            grid-area: title;
        }

        .Cart__productPrice,
        .Cart__productQuantity,
        .Cart__productTotal,
        .Cart__productDel {
            line-height: initial;
        }

        .Cart__productPrice {
            grid-area: price;
            text-align: right;
        }

        .Cart__productQuantity {
            grid-area: quantity;
            text-align: left;
        }

        .Cart__productQuantity::before {
            content: "x";
        }

        .Cart__productTotal {
            grid-area: total;
            text-align: right;
            color: red;
        }

        .Cart__productDel {
            grid-area: del;
            line-height: 60px;
            background: #ffc0cb26;
        }
    }
</style>
@endsection

@section('content')
<section class="" id="features3-7" style="padding-top:100px">
    <div class="container">
        <div class="Cart">
            <div class="Cart__header">
                <div class="Cart__headerGrid">商品</div>
                <div class="Cart__headerGrid">單價</div>
                <div class="Cart__headerGrid">數量</div>
                <div class="Cart__headerGrid">小計</div>
                <div class="Cart__headerGrid">刪除</div>
            </div>
            @foreach ($items as $item)
                <div class="Cart__product">
                    <div class="Cart__productGrid Cart__productImg"></div>
                    <div class="Cart__productGrid Cart__productTitle">
                        {{$item->name}}
                    </div>
                    <div class="Cart__productGrid Cart__productPrice">${{$item->price}}</div>
                    <div class="Cart__productGrid Cart__productQuantity">
                        <button class="btn btn-sm btn-info btn-minus" data-itemid="{{$item->id}}">-</button>
                        <span class="qty" data-itemid="{{$item->id}}">{{$item->quantity}}</span>
                        <button class="btn btn-sm btn-info btn-plus" data-itemid="{{$item->id}}">+</button>
                    </div>
                    <div class="Cart__productGrid Cart__productTotal">${{$item->price * $item->quantity}}</div>
                    <div class="Cart__productGrid Cart__productDel">
                        <button class="btn btn-sm btn-info btn-delete" data-itemid="{{$item->id}}">&times;</button>
                    </div>
                </div>
            @endforeach
        </div>

        <a class="btn btn-info" href="/cart_checkout">前往結帳</a>
    </div>
</section>

@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-minus').click(function () {
        var itemid = this.getAttribute('data-itemid');

        $.ajax({
            method: 'POST',
            url: '/update_cart/'+itemid,
            data: {
                quantity:-1
            },
            success: function (res) {
                var old_value = $(`.qty[data-itemid="${itemid}"]`).text();
                var new_value = parseInt(old_value) -1;
                $(`.qty[data-itemid="${itemid}"]`).text(new_value);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });

    });

    $('.btn-plus').click(function () {
        var itemid = this.getAttribute('data-itemid');

        $.ajax({
            method: 'POST',
            url: '/update_cart/'+itemid,
            data: {
                quantity:1
            },
            success: function (res) {
                var old_value = $(`.qty[data-itemid="${itemid}"]`).text();
                var new_value = parseInt(old_value) + 1;
                $(`.qty[data-itemid="${itemid}"]`).text(new_value);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });
    });

    $('.btn-delete').click(function () {
        var itemid = this.getAttribute('data-itemid');

        var r=confirm("確定要將此商品從購物車移除嗎?")
        if (r==true){
            $.ajax({
                method: 'POST',
                url: '/delete_cart/'+itemid,
                data: {},
                success: function (res) {
                    window.location.reload()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
    });

</script>

@endsection
