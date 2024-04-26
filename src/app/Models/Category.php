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

    // ItemCategoryモデルとの紐づけ
    public function itemCategories(){
        return $this->hasMany('App\Models\itemCategories');
    }

    // カテゴリーで検索
    public function scopeCategorySearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', "like", "%".$keyword."%");
        }
    }
}
