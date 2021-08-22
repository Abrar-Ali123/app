<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @method static find($id)
 * @method static doesnthave(string $string)
 * @method static has(string $string)
 * @property mixed delivery_fee
 * @property mixed default_tax
 * @property mixed longitude
 * @property mixed latitude
 * @property mixed address
 * @property mixed description
 * @property mixed mobile
 * @property mixed email
 * @property mixed name
 * @property false|mixed open
 * @property false|mixed available_for_delivery
 * @property false|mixed|string image_url
 * @property mixed delivery_range
 * @property mixed minimum_delivery_charge
 * @property mixed delivery_cost_multiplier
 */
class Shop extends Model
{

    use hasFactory;


    protected $fillable = [
        'name','manager_id','image_url'
    ];



    public function manager(){
        return $this->belongsTo(Manager::class);
    }

    public function shopReviews(){
        return $this->hasMany(ShopReview::class);
    }



    public static function updateShopImage(Request  $request,$id){
        $shop=Shop::find($id);
        $old_image = $shop->image_url;
        $path = $request->file('image')->store('shop_images', 'public');
        $shop->image_url=$path;
        $shop->save();
        Storage::disk('public')->delete($old_image);
    }


    public static function updateShopImageWithApi(Request  $request,$id){
        $shop=Shop::find($id);
        $old_image = $shop->image_url;
        $url = "shop_images/".Str::random(10).".jpg";
        $data = base64_decode($request->image);
        Storage::disk('public')->put($url, $data);
        $shop->image_url=$url;
        Storage::disk('public')->delete($old_image);
        return $shop->save();
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



    public function products(){
        return $this->hasMany(Product::class);
    }

    static function generateGoogleMapLocationUrl( $latitude,  $longitude){
        return "http://maps.google.com/maps?q=$latitude+$longitude";
    }

}
