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
    public function friends()
    {
        return $this->belongsToMany(Friend::class);
    }

}
