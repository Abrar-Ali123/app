<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, string $string1, $product_id)
 * @method static find($id)
 * @property int|mixed quantity
 * @property \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed shop_id
 * @property mixed user_id
 * @property mixed product_item_id
 * @property mixed product_id
 */
class Cart extends Model
{
    protected $fillable = [
        'product_id','quantity','user_id','active'
    ];



    public  function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
       return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function productItem(): BelongsTo
    {
        return $this->belongsTo(ProductItem::class);
    }
}
