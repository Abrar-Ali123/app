<?php

namespace App\Http\Controllers\Api\v1\Manager;

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
            return response(['errors' => ['You have not any shop yet']], 504);

        }

        return ProductReview::with('product','product.productImages','user')->where('shop_id','=',$shop->id)->get();

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
