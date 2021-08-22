<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @property false|mixed|string url
 */
class Banner extends Model
{
    use HasFactory;


    public static function deleteImage($id): bool
    {
        $banner = Banner::find($id);
        if($banner){
            Storage::disk('public')->delete($banner->url);
            return $banner->delete();
        }
        return false;
    }

    public static function saveImageWithKey(Request $request,$key): bool
    {
        $path = $request->file($key)->store('banner_images', 'public');
        $banner = new Banner();
        $banner->url = $path;
        return $banner->save();
    }
}
