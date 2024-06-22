<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Addressモデルとの紐づけ
    public function addresses(){
        return $this->hasMany('App\Models\Address');
    }

    // Itemモデルとの紐づけ
    public function items(){
        return $this->hasMany('App\Models\Item');
    }

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

    // お気に入りの商品の取得
    public function favoriteItems(){
        $likes = $this->likes;
        $items = [];
        for ($i=0; $i < $likes->count(); $i++) { 
            $items[$i] = $likes[$i]->item;
        }
        return $items;
    }

    // 購入した商品の取得
    public function purchasedItems(){
        $orders = $this->orders;
        $items = [];
        for ($i=0; $i < $orders->count(); $i++) { 
            $items[$i] = $orders[$i]->item;
        }
        return $items;
    }
}
