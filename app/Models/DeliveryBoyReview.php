<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, $id)
 * @method static find($id)
 * @property mixed delivery_boy_id
 * @property mixed order_id
 * @property mixed user_id
 * @property mixed review
 * @property mixed rating
 */
class DeliveryBoyReview extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
