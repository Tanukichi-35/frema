<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_code',
        'address',
        'building',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->hasOne('App\Models\User');
    }

    // Orderモデルとの紐づけ
    public function order(){
        return $this->hasOne('App\Models\Order');
    }
}
