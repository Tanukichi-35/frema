<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Itemモデルとの紐づけ
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    // お気に入りアイテムの取得
    public static function getLike(int $user_id, string $item_id){
      return Like::where("user_id", '=', $user_id)->where("item_id", '=', $item_id)->first();
    }

    // お気に入りステータスの確認
    public static function checkLike(int $user_id, string $item_id){
        if($user_id == 0){
            return session()->has(Item::find($item_id)->name);
        }
        else{
            return Like::where("user_id", '=', $user_id)->where("item_id", '=', $item_id)->exists();
        }
    }
}
