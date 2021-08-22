<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property mixed pincode
 * @property mixed city
 * @property mixed address2
 * @property mixed address
 * @property mixed latitude
 * @property mixed longitude
 * @property mixed type
 * @method static find($address_id)
 */
class UserAddress extends Model
{
    use HasFactory;

    static $HOME = 0;
    static $WORK = 1;
    static $OTHER = 2;



    public function user(){
        $this->belongsTo(User::class);

    }

    public static function setAllDefaultOff($user_id){
        foreach (UserAddress::where('user_id',$user_id)->get() as $userAddress){
            $userAddress->default = false;
            $userAddress->save();
        }
    }



}
