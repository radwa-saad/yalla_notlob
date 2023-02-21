<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;


class Friend_order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','friends','order_id'];
    protected $table="friend_order";

    public function orders(){

        return $this->belongsToMany(Order::class);
    }
    public function users(){

        return $this->belongsToMany(User::class);
    }
    }

