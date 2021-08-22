<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }


    public function store(Request $request,$id)
    {

        if($request->hasFile('file')){
            return ProductImage::saveImageWithKey($request, $id,'file');
        }
        return false;
    }

    public function show($id)
    {
    }


    public function edit($id)
    {

        $productImages = ProductImage::where('product_id','=',$id)->get();

        foreach($productImages as $productImage){
            $productImage->url = asset('storage/'.$productImage->url);
        }

        return view('manager.products.edit-product-images')->with([
            'productImages'=> $productImages,
            'productId'=>$id
        ]);
    }


    public function update(Request $request)
    {

    }


    public function destroy(Request $request)
    {

        $this->validate($request,[
            'id'=>'required'
        ]);

        return ProductImage::deleteImage($request->id);
    }

}
