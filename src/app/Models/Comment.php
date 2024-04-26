<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
        'comment',
    ];

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Itemモデルとの紐づけ
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    // コメントアイテムの取得
    public static function getComment(int $user_id, int $item_id){
        return Comment::where("user_id", '=', $user_id)->where("item_id", '=', $item_id)->first();
    }

    // コメントテータスの確認
    public static function checkComment(int $user_id, int $item_id){
      if($user_id == 0){
          return session()->has(Store::find($item_id)->name);
      }
      else{
          return Comment::where("user_id", '=', $user_id)->where("item_id", '=', $item_id)->exists();
      }
    }

    // 自身のコメント？
    public function isOwner(){
        return $this->user_id == Auth::user()->id;
    }
}
