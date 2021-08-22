<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShopReviewController extends Controller
{

    public function store(Request $request)
    {

    }


    public function destroy($id): RedirectResponse
    {

        $shopReview = ShopReview::find($id);
        $shop = Shop::find($shopReview->shop_id);

        if ($shopReview && $shop) {
            $totalRating = $shop->total_rating;
            if ($totalRating > 1) {
                $shop->rating = (($shop->rating * $totalRating) - $shopReview->rating) / ($totalRating - 1);
                $shop->total_rating = $totalRating - 1;
            } else {
                $shop->total_rating = 0;
                $shop->rating = 0;
            }
            if ($shopReview->delete() && $shop->save()){
                return redirect()->back()->with('message', 'Review removed');
            }else {
                return redirect()->back()->with('error', 'Something wrong');
            }
        } else {
            return redirect()->back()->with('error', 'Something wrong');
        }
    }


}
