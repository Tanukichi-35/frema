<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Auth;
use DateTime;

class Item extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
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
    public function itemCategories(){
        return $this->hasMany('App\Models\ItemCategory');
    }

    // アイテムをアイテム名とカテゴリーで検索
    public function scopeItemSearch($query, $keyword, $item_categories)
    {
        if (!empty($keyword)) {
            $query->where(function ($query) use($keyword, $item_categories) {
                $query->where('name', "like", "%".$keyword."%");
                foreach ($item_categories as $item_category) {
                    $query->orWhere('id', '=', $item_category->item_id);
                }
            });

            // $query->where('name', "like", "%".$keyword."%");
        }
    }

    // uuidの一致する商品を取得
    public static function getItem($id){
        return self::Where('id', '=', $id)->first();
    }
}
