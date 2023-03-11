<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Freind extends Model
{
    use HasFactory;
    protected $table="friend_user";
    protected $fillable=["name" ,"email","user_id","image"];

    // public function users(){
    //     return $this->belongsToMany(User::class);
    // }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
