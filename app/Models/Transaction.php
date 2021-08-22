<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed delivery_boy_revenue
 * @property mixed delivery_boy_id
 * @property mixed shop_revenue
 * @property mixed shop_id
 * @property mixed admin_revenue
 * @property mixed order_payment_id
 * @property mixed order_id
 * @property mixed pay_to_shop
 * @property mixed admin_to_delivery_boy
 * @property mixed admin_to_shop
 * @property mixed delivery_boy_to_shop
 * @property mixed delivery_boy_to_admin
 * @property mixed shop_to_admin
 * @property mixed total
 * @property false|mixed success
 * @method static where(string $string, string $string1, $id)
 */
class Transaction extends Model
{
    use HasFactory;

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderPayment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OrderPayment::class);
    }
    public function shop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function deliveryBoy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
}
