@extends('layouts/nav')

@section('css')
<link rel="stylesheet" href="{{asset('css/product_detail.css')}}">
@endsection

@section('content')
<section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding-top:100px">
    <div class="container">
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                <div class="product-card">
                    <div class="product-info">
                        <div class="title">{{$Product->title}}</div>
                        <div class="sub-title">6GB+128GB, 珍珠白</div>
                        <div class="price">NT$7,599</div>
                    </div>
                    <div class="product-tips">
                        icon雙倍該商品可享受雙倍積分
                    </div>
                    <div class="product-capacity">
                        容量
                        <div class="row">
                            <div class="col-4">
                                <div class="color">
                                    6GB+64GB
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color">
                                    12GB+128GB
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="product-color">
                        顏色
                        <div class="row">
                            <div class="col-4">
                                <div class="color active" data-color="紅">
                                    紅
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color" data-color="黃">
                                    黃
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color" data-color="綠">
                                    綠
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color" data-color="紫">
                                    紫
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="/add_cart/{{$Product->id}}" method="post">
                        @csrf

                        <div class="product-qty">
                            數量
                            <a id="minus" href="#">-</a>
                            <input type="number" value="1" id="qty" min="0">
                            <a id="plus" href="#">+</a>
                        </div>

                        <div class="product-total">
                            <div>
                                <span>Redmi Note 8 Pro</span>
                                <span>珍珠白</span>
                                <span>6GB+128GB</span> * <span>1</span>
                                NT${{$Product->price}}
                            </div>
                        </div>
                        <input type="text" name="capacity" id="capacity"  value="6GB+128GB" hidden>
                        <input type="text" name="color" id="color" value="紅" hidden>
                        <button>立即購買</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    $('.card-box *').attr('style','');

    $('.product-card .color').click(function () {

        //change 長相
        $('.product-card .color').removeClass("active");
        $(this).addClass("active");

        //把顏色 放入 input的value中

        //get data attr value
        var color =  $(this).attr("data-color");

        //change input value
        $('#color').val(color);
    });


    $(function(){

        var valueElement = $('#qty');
        function incrementValue(e){
            //get now value
            var now_number = $('#qty').val();
            //add increment value
            var new_number  = Math.max(e.data.increment + parseInt(now_number) , 0);
            $('#qty').val(new_number);

            return false;
        }

        $('#plus').bind('click', {increment: 1}, incrementValue);
        $('#minus').bind('click', {increment: -1}, incrementValue);
});
</script>

@endsection
