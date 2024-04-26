<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'address_id',
        'user_id',
        'payment_method',
        'status',
    ];

    // Itemモデルとの紐づけ
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    // Addressモデルとの紐づけ
    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    // Userモデルとの紐づけ
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // 初期化
    public function init($item_id, $user){
        $this->item_id = $item_id;
        $this->user_id = $user->id;
        $this->address_id = $user->addresses[0]->id;
        $this->payment_method = 0;
        $this->status = 0;
    }

    // 支払い方法を取得
    public function getPayment(){
        switch ($this->payment_method) {
            case '0':
                return 'クレジットカード';
            case '1':
                return 'コンビニ払い';
            case '2':
                return '銀行振込';
            default:
                return '未設定';
        }
    }
}
