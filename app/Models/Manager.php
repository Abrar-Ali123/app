<?php

namespace App\Models;

use App\Notifications\ManagerResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

/**
 * @property mixed|string password
 * @property mixed email
 * @property mixed name
 * @method static find($id)
 * @method static doesnthave(string $string)
 */
class Manager extends Authenticatable
{
    use Notifiable,HasApiTokens,hasFactory;


    //protected $guard = 'manager';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',
    ];


    public function shop(){
        return $this->hasOne(Shop::class);
    }


    public static function updateManagerAvatar(Request  $request,$id){
        $manager=Manager::find($id);
        $old_image = $manager->avatar_url;
        $path = $request->file('image')->store('manager_avatars', 'public');
        $manager->avatar_url=$path;
        $manager->save();
        Storage::disk('public')->delete($old_image);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ManagerResetPasswordNotification($token));
    }


    public function getLocale(){
        if($this->locale!=null)
            return $this->locale;
        return "en";
    }

}
