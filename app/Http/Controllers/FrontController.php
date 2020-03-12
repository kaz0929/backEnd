<?php

namespace App\Http\Controllers;

use App\News;
use App\Products;
use App\ProductTypes;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function add_cart($productId)
    {
        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = $productId; // generate a unique() row ID
        $userID =  Auth::user()->id; // the user ID to bind the cart contents

        // add the product to cart
        Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('cart');
    }

    public function cart_total()
    {
        $userID =  Auth::user()->id;
        $items = \Cart::session($userID)->getContent();

        return view('front.cart', compact('items'));
    }
}
