<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Friend extends Model
{
    use HasFactory;
    protected $fillable=['user_id','group_id','friend_id'];
    protected $table = 'group_friend';
    
    public function groups(){
        return $this->belongsToMany(Group::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
