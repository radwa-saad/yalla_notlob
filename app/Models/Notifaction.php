<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'message', 'sender_id', 'receiver_id', 'status'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
}
