<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'postcode',
        'address',
        'building',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Orderモデルとの紐づけ
    public function order(){
        return $this->hasOne('App\Models\Order');
    }
}
