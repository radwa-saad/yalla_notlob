<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Group;
use App\Models\UserGroup;
use App\Models\Freind;
use App\Models\Freind_order;
use App\Models\Order;
use App\Models\Order_details;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'google_id',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function friends()
    {
        return $this->hasMany(Freind::class);
    }
    public function friends_order()
    {
        return $this->hasMany(Freind_order::class);
    }
    public function group_friend()
    {
        return $this->hasMany(Group_Friend::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function order_details()
    {
        return $this->hasMany(Order_details::class);
    }


    // public function user_groups(){
    //     return $this->belongsToMany(UserGroup::class);
    // }
}
