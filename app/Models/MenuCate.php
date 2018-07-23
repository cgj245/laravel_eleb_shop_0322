<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCate extends Model
{
    protected $fillable=['name','description','is_selected','shop_id','type_accumulation'];

    public function shop()
    {
        return $this->hasOne(Shop::class,'id','shop_id');
    }
}
