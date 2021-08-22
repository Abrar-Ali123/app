<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return Category::with('subCategories')->get();
    }

    public function create()
    {

    }


    public function show($id)
    {
    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id){

    }

    public function getProducts($id): array
    {
        $user_id = auth()->user()->id;
        $products = Product::with('productImages','productItems','productItems.productItemFeatures')->where('active','=',true)->where('category_id',$id)->get();
        $filterProduct = [];
        foreach ($products as $product){
            if(Favorite::where('user_id','=',$user_id)->where('product_id','=',$product['id'])->exists()){
                $product['is_favorite'] = true;
            }else{
                $product['is_favorite'] = false;
            }
            array_push($filterProduct,$product);
        }
        return $filterProduct;
    }

}
