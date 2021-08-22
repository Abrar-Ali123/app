<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static find($id)
 * @property mixed title
 * @property mixed image_url
 * @property mixed description
 */
class Category extends Model
{
    use hasFactory;

    protected $fillable = [
        'title', 'description', 'image_url'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }


    public static function activateCategory($id): bool
    {
        $sub_categories =  SubCategory::where('category_id',$id)->get();
        foreach ($sub_categories as $sub_category) {
          SubCategory::activateSubCategory($sub_category->id);
        }
        $category = Category::find($id);
        $category->active = true;
        $category->save();
        return true;
    }

    public static function disableCategory($id): bool
    {
        $sub_categories =  SubCategory::where('category_id',$id)->get();
        foreach ($sub_categories as $sub_category) {
          SubCategory::disableSubCategory($sub_category->id);
        }
        $category = Category::find($id);
        $category->active = false;
        $category->save();
        return true;
    }
}
