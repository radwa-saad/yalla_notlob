<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','order_for','restaurant_name','menu_image'];
    protected $table="orders";
    public function orders(){
        return $this->hasOne(Order::class);
    }
    public function friend_order()
    {
        return $this->belongsToMany(Friend_order::class);
    }

}
