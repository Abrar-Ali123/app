<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use App\Notifications\DeliveryBoyResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @method static where(string $string, string $string1, $string2)
 * @method static find($delivery_boy_id)
 * @method static doesnthave(string $string)
 * @method static has(string $string)
 */
class DeliveryBoy extends Authenticatable
{
    use Notifiable,HasApiTokens, HasFactory;


    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DeliveryBoyResetPasswordNotification($token));
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

}
