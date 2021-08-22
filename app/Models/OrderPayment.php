<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed payment_type
 * @property mixed order_id
 * @property mixed|string stripe_id
 * @property mixed card_number
 * @property mixed id
 * @method static find(\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed $id)
 */
class OrderPayment extends Model
{
    use HasFactory;
}
