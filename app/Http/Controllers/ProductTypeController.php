<?php

namespace App\Http\Controllers;


use App\ProductTypes;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $items = ProductTypes::all();
        return view('admin/productType/index',compact('items'));
    }

    public function create()
    {
        return view('admin/productType/create');
    }

    public function store(Request $request)
    {
        $types = $request->all();
        $product_types = ProductTypes::create($types);
        $product_types->save();

        return redirect('/home/productType');
    }

    public function edit($id)
    {
        // $news = News::where('id','=',$id)->first();

        $productType = ProductTypes::find($id);

        return view('admin/productType/edit', compact('productType'));
    }

    public function update(Request $request, $id)
    {
        $request_data = $request->all();

        $item = ProductTypes::find($id);

        $item->update($request_data);

        return redirect('/home/productType');
    }

    public function delete(Request $request, $id)
    {
        $item = ProductTypes::find($id);
        $item->delete();

        return redirect('/home/productType');
    }

}
