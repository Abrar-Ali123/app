<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\Manager;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {

        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code'=>502,
                'error'=> 'You havn\'t any shop yet',
                'message'=> 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url'=> route('manager.shops.index')
            ]);
        }


        $reviews = ProductReview::with('product','product.productImages')->where('shop_id','=',$shop->id)->paginate(10);

        return view('manager.reviews.reviews')->with([
            'reviews'=>$reviews
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
}
