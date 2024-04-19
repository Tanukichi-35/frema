<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'item_id',
    ];

    // Categoryモデルとの紐づけ
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    // Itemモデルとの紐づけ
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
