<?php

namespace App\Http\Controllers\Api\v1\Manager;

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
        if(ProductImage::saveImageWithApi($request,$id)){
            return response(['message' => ['Product image uploaded']], 200);
        }
        return response(['errors' => ['Product image not uploaded']], 403);
    }

    public function show($id)
    {
    }




    public function update(Request $request)
    {

    }

    public function destroy($id)
    {

        if(ProductImage::deleteImage($id)){
            return response(['message' => ['Product image deleted']], 200);
        }
        return response(['errors' => ['Product image not deleted']], 403);

    }


}
