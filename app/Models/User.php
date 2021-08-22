<?php

namespace App\Models;

use App\Notifications\DeliveryBoyResetPasswordNotification;
use App\Notifications\UserResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

/**
 * @method static find($user_id)
 * @method static where(string $string, mixed $mobile)
 * @method static paginate(int $int)
 * @property mixed locale
 * @property mixed name
 * @property mixed email
 * @property mixed fcm_token
 * @property mixed|string password
 */
class User extends Authenticatable
{
    use Notifiable,HasApiTokens,hasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'favorites','user_id','product_id')->withTimeStamps();
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }


    public function getLocale(): string
    {
        if($this->locale!=null)
            return $this->locale;
        return "en";
    }



    public static function updateUserAvatar(Request  $request,$id){
        $user=User::find($id);
        $old_image = $user->avatar_url;
        $path = $request->file('image')->store('user_avatars', 'public');
        $user->avatar_url=$path;
        $user->save();
        Storage::disk('public')->delete($old_image);
    }



}
