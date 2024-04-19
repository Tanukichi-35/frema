<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'address_id',
        'user_id',
        'payment_method',
        'status',
    ];

    // Itemモデルとの紐づけ
    public function items(){
        return $this->belongsTo('App\Models\Item');
    }

    // Addressモデルとの紐づけ
    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    // Userモデルとの紐づけ
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
