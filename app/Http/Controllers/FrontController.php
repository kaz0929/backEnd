<?php

namespace App\Http\Controllers;

use App\News;
use App\Products;
use App\ProductTypes;
use Illuminate\Http\Request;

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
}
