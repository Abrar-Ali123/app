<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): array
    {

        $user_id = $request->user()->id;
        $sub_category_ids = $request->query('sub_category_ids');
        $name = $request->query('name');
        $offer = $request->query('offer');
        if($sub_category_ids)
            $subCategories = explode(',',$sub_category_ids);
        else
            $subCategories = null;
        $products = Product::with('productImages','productItems','productItems.productItemFeatures')->where('active','=',true)->get()->toArray();
        $filterProduct = [];
        foreach ($products as $product){
            if(Favorite::where('user_id','=',$user_id)->where('product_id','=',$product['id'])->exists()){
                $product['is_favorite'] = true;
            }else{
                $product['is_favorite'] = false;
            }
            if($this->isEligible($product,$subCategories,$name,$offer)){
                array_push($filterProduct,$product);
            }

            //TODO : Add more filters
        }
        return $filterProduct;

    }

    private function isEligible($product,$categories,$name,$offer): bool
    {
        $eligible = true;
        if($categories){
            if(!in_array( $product['sub_category_id'],$categories))
                $eligible = $eligible && false;
        }
        if($name){
            if(!preg_match("/{$name}/i",$product['name'])){
                $eligible = $eligible && false;
            }
        }
        if($offer){
            if($product['offer']==0)
                $eligible = $eligible && false;
        }
        return $eligible;
    }

    public function show(Request $request,$id)
    {
        $user_id = $request->user()->id;
        $product = Product::with('category','productImages','shop','shop.manager','productReviews','productItems','productItems.productItemFeatures')->find($id);
        if(Favorite::where('user_id','=',$user_id)->where('product_id','=',$product['id'])->exists()){
            $product['is_favorite'] = true;
        }else{
            $product['is_favorite'] = false;
        }
        return $product;
    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id){

    }

    public function searchAndFilter(){

    }

    public function showReviews($productId){
        return Product::with('productReviews','productReviews.user')->find($productId);
    }

}
