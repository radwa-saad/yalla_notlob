<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;


class Friend_order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','friend_id','order_id'];
    protected $table="friend_order";


   
    }

