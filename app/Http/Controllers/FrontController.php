<?php

namespace App\Http\Controllers;

use Cart;
use App\News;
use App\Order;
use App\Products;
use App\ContactUs;
use App\OrderDetail;
use App\ProductTypes;
use App\Mail\SendToUser;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index() {
        return view('front/index');
    }

    public function news() {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/news',compact('news_data'));
    }

    public function news_detail($id)
    {
        $news = News::with('news_imgs')->find($id);
        return view('front.news_detail',compact('news'));
    }

    public function products() {
        $products = Products::all();

        return view('front/products',compact('products'));
    }

    public function products_detail($productId)
    {
        $Product = Products::find($productId);
        return view('front/product_detial',compact('Product'));
    }

    public function contactUs() {
        return view('front/contactUs');
    }

    public function contactUs_store(Request $request)
    {
        $user_data = $request->all();
        $content = ContactUs::create($user_data);


        Mail::to($user_data->email)->send(new OrderShipped($content)); // 寄信user
        Mail::to('e9fe460311-110edf@inbox.mailtrap.io')->send(new OrderShipped($content)); // 寄信admin

        return redirect('/contactUs');
    }

    //購物車

    public function add_cart($productId)
    {
        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = $productId; // generate a unique() row ID

        // add the product to cart
        Cart::add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('cart');
    }

    public function update_cart(Request $request,$product_id)
    {
        $quantity = $request->quantity;

        Cart::update($product_id, array(
            'quantity' => $quantity, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
          ));

        return 'success';
    }

    public function delete_cart(Request $request,$product_id)
    {
        Cart::remove($product_id);

        return 'success';
    }

    public function cart_total()
    {
        $items = \Cart::getContent()->sort();

        return view('front.cart', compact('items'));
    }

    public function cart_checkout()
    {
        $items = \Cart::getContent()->sort();
        return view('front.cart_checkout', compact('items'));
    }

    public function post_cart_checkout(Request $request)
    {
        $recipient_name = $request->recipient_name;
        $recipient_phone = $request->recipient_phone;
        $recipient_address = $request->recipient_address;
        $shipment_time = $request->shipment_time;

        //建立訂單
        $total_price = \Cart::getTotal();
        if($total_price > 1200){
            $shipment_price = 0;
        }else{
            $shipment_price = 120;
        }

        $order = new Order();
        $order->recipient_name = $recipient_name;
        $order->recipient_phone =  $recipient_phone;
        $order->recipient_address =  $recipient_address;
        $order->shipment_time =  $shipment_time;
        $order->total_price =  $total_price;
        $order->shipment_price =  $shipment_price;
        $order->save();

        $new_order_id = $order->id;

        //建立訂單詳細
        $items = Cart::getContent();
        foreach($items as $row) {
            $order_detail = new OrderDetail();
            $order_detail->order_id =  $new_order_id;
            $order_detail->product_id =  $row->id;;
            $order_detail->qty =  $row->quantity;
            $order_detail->price =  $row->price;
            $order_detail->save();
        }


        //產生訂單編號

        //送出訂單至第三方支付
    }

}
