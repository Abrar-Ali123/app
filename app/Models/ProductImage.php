<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @property false|mixed|string url
 * @property mixed product_id
 * @method static where(string $string, string $string1, $product_id)
 */
class ProductImage extends Model
{

    protected $fillable = [
        'url', 'product_id'
    ];


    public static function saveImage(Request $request, $product_id)
    {
        $path = $request->file('image')->store('product_images', 'public');
        $productImage = new ProductImage();
        $productImage->url = $path;
        $productImage->product_id = $product_id;
        $productImage->save();
    }

    public static function saveImageWithKey(Request $request, $product_id,$key): bool
    {
        $path = $request->file($key)->store('product_images', 'public');
        $productImage = new ProductImage();
        $productImage->url = $path;
        $productImage->product_id = $product_id;
        return $productImage->save();
    }


    public static function saveImageWithApi(Request $request, $product_id): bool
    {
        $url = "product_images/".Str::random(10).".jpg";
        $data = base64_decode($request->image);
        Storage::disk('public')->put($url, $data);
        $productImage = new ProductImage();
        $productImage->url = $url;
        $productImage->product_id = $product_id;
        return $productImage->save();
    }



    public static function updateImage(Request $request, $product_id)
    {
        $productImage = ProductImage::where('product_id','=',$product_id)->first();
        if($productImage) {
            $old_image = $productImage->url;
            Storage::disk('public')->delete($old_image);
            $path = $request->file('image')->store('product_images', 'public');
            $productImage->url = $path;
            $productImage->save();
        }
    }

    public static function deleteImage($id): bool
    {
        $productImage = ProductImage::find($id);
        if($productImage){
            Storage::disk('public')->delete($productImage->url);
            return $productImage->delete();
        }
        return false;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
