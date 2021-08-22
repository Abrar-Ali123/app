<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed shop_id
 * @property mixed order_id
 * @property mixed user_id
 * @property mixed product_id
 * @property mixed review
 * @property mixed rating
 * @property mixed product_item_id
 * @method static where(string $string, string $string1, \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed $id)
 */
class ProductReview extends Model
{

    use HasFactory;




    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function getColorFromRating($rating): string
    {
        if($rating<1.5)
            return "#fc1926";
        else if($rating<2.5)
            return "#fc1926";
        else if($rating<3.5)
            return "#ffcb2e";
        else if($rating<4.5)
            return "#35cc71";
        else
            return "#35cc71";
    }

}
