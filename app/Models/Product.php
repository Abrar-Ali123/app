<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed shop_id
 * @property mixed|string offer
 * @property mixed|string quantity
 * @property mixed|string price
 * @property mixed|string category_id
 * @property mixed|string description
 * @property mixed|string name
 * @property mixed revenue
 * @property mixed items
 * @property mixed sub_category_id
 * @method static find($id)
 * @method static where(string $string, $id)
 */
class Product extends Model
{



    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'favourites','product_id','user_id')->withTimestamps();
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

   public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function productReviews(){
        return $this->hasMany(ProductReview::class);
    }

    public function productItems(){
        return $this->hasMany(ProductItem::class);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);

    }


    public static function getDiscountedPrice($price,$discount){
        return $price*(100-$discount)/100;
    }

    public static function getPlaceholderImage(): string
    {
        return asset('/storage/placeholder_images/no_product.png');
    }


}
