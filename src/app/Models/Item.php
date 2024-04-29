<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use Auth;
use DateTime;

class Item extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id',
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

    // お気に入りステータスの確認
    public function checkLike(){
        if(Auth::user()){
            return Like::checkLike(Auth::user()->id, $this->id);
        }
        else{
            return Like::checkLike(0, $this->id);
        }
    }

    // お気に入り数の取得
    public function getLikeNumber(){
        $number = Like::where('item_id', '=', $this->id)->count();

        // 認証前の状態でお気に入り追加されている場合
        if(!Auth::user()){
            if($this->checkLike()){
                $number++;
            }
        }

        return $number;
    }

    // コメント数の取得
    public function getCommentNumber(){
        return Comment::where('item_id', '=', $this->id)->count();
    }
}
