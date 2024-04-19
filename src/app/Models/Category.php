<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    // Itemモデルとの紐づけ
    public function item_categories(){
        return $this->hasMany('App\Models\ItemCategories');
    }
}
