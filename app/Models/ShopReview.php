<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed shop_id
 * @property mixed user_id
 * @property mixed review
 * @property mixed rating
 * @method static find($id)
 * @method static where(string $string, string $string1, $user_id)
 */
class ShopReview extends Model
{
    use HasFactory;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
