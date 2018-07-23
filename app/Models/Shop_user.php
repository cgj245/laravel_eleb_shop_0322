<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Shop_user extends Authenticatable
{

    use Notifiable;
    protected $fillable=['name','email','password','status','shop_id'];

    public function Shop()
    {
        return $this->hasOne(Shop::class,'id','shop_id');
    }
}
