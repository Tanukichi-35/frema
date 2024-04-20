<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DateTime;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'condition_id',
        'price',
        'img_url',
    ];

    // Orderモデルとの紐づけ
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    // Likeモデルとの紐づけ
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    // Commentモデルとの紐づけ
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    // userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Conditionモデルとの紐づけ
    public function condition(){
        return $this->belongsTo('App\Models\Condition');
    }

    // ItemCategoryモデルとの紐づけ
    public function item_categories(){
        return $this->hasMany('App\Models\ItemCategory');
    }

    // カテゴリーで検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id) || $category_id != 0) {
            $query->where('category_id', $category_id);
        }
    }

    // アイテム名で検索
    public function scopeItemSearch($query, $item_name)
    {
        if (!empty($item_name)) {
            $query->where('name', "like", "%".$item_name."%");
        }
    }
}
