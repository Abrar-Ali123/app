<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed order_id
 * @property \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed delivery_boy_id
 * @property int|mixed products_count
 * @property mixed revenue
 * @property mixed shop_id
 * @method static where(string $string, string $string1, \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy $deliveryBoyId)
 */
class DeliveryBoyRevenue extends Model
{
    use HasFactory;
}
