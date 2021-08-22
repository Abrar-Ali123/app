<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyReview;
use App\Models\ShopReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeliveryBoyReviewController extends Controller
{

    public function store(Request $request)
    {

    }


    public function destroy($id): RedirectResponse
    {

        $deliveryBoyReview = DeliveryBoyReview::find($id);
        $deliveryBoy = DeliveryBoy::find($deliveryBoyReview->delivery_boy_id);

        if ($deliveryBoyReview && $deliveryBoy) {
            $totalRating = $deliveryBoy->total_rating;
            if ($totalRating > 1) {
                $deliveryBoy->rating = (($deliveryBoy->rating * $totalRating) - $deliveryBoyReview->rating) / ($totalRating - 1);
                $deliveryBoy->total_rating = $totalRating - 1;
            } else {
                $deliveryBoy->total_rating = 0;
                $deliveryBoy->rating = 0;
            }
            if ($deliveryBoyReview->delete() && $deliveryBoy->save()){
                return redirect()->back()->with('message', 'Review removed');
            }else {
                return redirect()->back()->with('message', 'Something wrong');
            }
        } else {
            return redirect()->back()->with('message', 'Something wrong');
        }
    }


}
