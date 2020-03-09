<?php

namespace App\Http\Controllers;


use App\Products;
use App\ProductTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $types = ProductTypes::all();
        return view('admin/product/index',compact('products','types'));
    }

    public function create()
    {
        $productTypes = ProductTypes::all();
        return view('admin/product/create',compact('productTypes'));
    }

    public function store(Request $request)
    {
        $products_data = $request->all();

        //上傳主要圖片
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file,'products');
            $products_data['img'] = $path;
        }

        Products::create($products_data);

        return redirect('/home/products');
    }

    public function edit($id)
    {
        $productTypes = ProductTypes::all();
        $products = Products::find($id);
        return view('admin/product/edit',compact('productTypes','products'));
    }

    public function update(Request $request, $id)
    {

        $request_data = $request->all();

        $item = Products::find($id);

        //if有上傳新圖片
        if($request->hasFile('img')){
            //舊圖片刪除
            $old_image = $item->img;
            File::delete(public_path().$old_image);

            //上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file,'products');
            $request_data['img'] = $path;
        }

        $item->update($request_data);

        return redirect('/home/products');
    }

    public function delete(Request $request, $id)
    {
        $item = Products::find($id);

        $old_image = $item->img;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }

        $item->delete();

        return redirect('/home/products');
    }




    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }

}
