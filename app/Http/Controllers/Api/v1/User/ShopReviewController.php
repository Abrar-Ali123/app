<?php


namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Shop;
use App\Models\ShopReview;
use App\Rules\RatingRule;
use Illuminate\Http\Request;

class ShopReviewController extends Controller
{

    public function store(Request $request)
    {

        $this->validate($request, [
            'shop_id' => 'required',
            'rating' => [
                'required',
                new RatingRule()
            ],
        ]);

        $user_id = auth()->user()->id;
        $shop = Shop::find($request->shop_id);

        if ($shop) {
            $shopReview= ShopReview::where('shop_id', '=', $shop->id)->where('user_id', '=', $user_id)->get();
            if ($shopReview->count() > 0) {
                return response(['errors' => ['This shop is already reviewed']], 403);
            }

            $total_rating = $shop->total_rating;
            $shop->rating = ($shop->rating * $total_rating + $request->rating) / ($total_rating + 1);
            $shop->total_rating = $total_rating+1;

            $shopReview = new ShopReview();
            $shopReview->rating = $request->rating;
            $shopReview->review = $request->review;
            $shopReview->user_id = $user_id;
            $shopReview->shop_id = $shop->id;
            if($shopReview->save() && $shop->save())
                return response(['message' => ['This shop is been reviewed']], 200);
        }else {
            return response(['errors' => ['This shop is not available']], 403);
        }
        return response(['message' => ['There is something wrong']], 403);
    }



}
