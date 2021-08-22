<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * @method static find($id)
 * @property mixed|string password
 * @property mixed email
 * @property mixed name
 * @property mixed locale
 */
class Admin extends Authenticatable
{
    use Notifiable,hasFactory;


    protected $guard = 'admin';
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


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public static function updateAdminAvatar(Request  $request,$id){
        $admin=Admin::find($id);
        $old_image = $admin->avatar_url;
        $path = $request->file('image')->store('admin_avatars', 'public');
        $admin->avatar_url=$path;
        $admin->save();
        Storage::disk('public')->delete($old_image);
    }


    public function getLocale(): string
    {
        if($this->locale!=null)
            return $this->locale;
        return "en";
    }


}
