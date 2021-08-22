<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, $order_id)
 * @property int|mixed products_count
 * @property mixed order_id
 * @property float|int|mixed revenue
 * @property mixed shop_id
 */
class ShopRevenue extends Model
{
    use HasFactory;



    public function order(){
        return $this->belongsTo(Order::class);
    }
}
