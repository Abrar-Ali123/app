<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static find(mixed $get)
 * @method static where(string $string, $id)
 * @property mixed category_id
 * @property mixed description
 * @property mixed title
 */
class SubCategory extends Model
{
    use HasFactory;

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public static function activateSubCategory($id): bool
    {
        $products =  Product::where('sub_category_id',$id)->get();
        foreach ($products as $product) {
            $product->active = true;
            $product->save();
        }
        $subCategory = SubCategory::find($id);
        $subCategory->active = true;
        $subCategory->save();
        return true;
    }

    public static function disableSubCategory($id): bool
    {
        $products =  Product::where('sub_category_id',$id)->get();
        foreach ($products as $product) {
            $product->active = false;
            Cart::where('product_id', '=', $product->id)->where('active', '=', true)->delete();
            $product->save();
        }
        $subCategory = SubCategory::find($id);
        $subCategory->active = false;
        $subCategory->save();
        return true;



    }
}
