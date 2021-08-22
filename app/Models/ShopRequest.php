<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed manager_id
 * @property mixed shop_id
 * @method static where(string $string, $id)
 */
class ShopRequest extends Model
{
    protected $fillable = [
        'shop_id','manager_id'
    ];


    public function managers(){
        return $this->hasMany(Manager::class);
    }

    public function shops(){
        return $this->hasMany(Shop::class);
    }
}
