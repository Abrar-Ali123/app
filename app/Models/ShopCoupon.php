<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed coupon_id
 * @property mixed shop_id
 * @method static create(int[] $shopCoupon)
 */
class ShopCoupon extends Model
{
    use HasFactory;

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

}
