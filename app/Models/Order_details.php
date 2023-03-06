<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','item' , 'quantity','price' , 'order_id','comment','invetation_id'];

    public function order_details(){
        return $this->belongsTo(Order::class);
    }
}
