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

    // カテゴリーで検索
    public function scopeCategorySearch($query, $categories)
    {
        if (!empty($categories)) {
            $query->where(function ($query) use($categories) {
                foreach ($categories as $category) {
                    $query->orWhere('category_id', $category->id);
                }
            });
        }
    }
}
