<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        //$products = Product::with('productImages')->where('name','LIKE','%T-shirt Pink%')->paginate(12);
        //return $products;

        $name = $request->query('name');
        if($name){
            $products = Product::with('productImages')->where('active','=',true)->where('name','LIKE','%'.$name.'%')->paginate(7);
        }else{
            $products = Product::with('productImages')->where('active','=',true)->paginate(12);

        }



        return view('user.products.products',[
            'products'=>$products,
            'search_name'=>$name
        ]);
    }

    public function create()
    {



    }


    public function store(Request $request)
    {



    }


    public function show($id)
    {
        $user_id = auth()->user()->id;
        $product = Product::with('productItems','productItems.productItemFeatures')->find($id);

        if(!$product->active){
            return view('user.error-page')->with([
                'code' => 502,
                'error' => 'This product is not available',
                'message' => 'Please go to products',
                'redirect_text' => 'Go to product',
                'redirect_url' => route('user.products.index')
            ]);
        }

        $product->is_favorite =  Favorite::where('product_id',$id)->where('user_id',$user_id)->exists();


        return view('user.products.show-product')->with([
            'product'=>$product
        ]);
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function showReviews($id){
        $product = Product::with('productReviews','productReviews.user')->find($id);
        return view('user.products.reviews')->with([
            'product'=>$product
        ]);
    }

    public function filter(Request $request){





    }

}
