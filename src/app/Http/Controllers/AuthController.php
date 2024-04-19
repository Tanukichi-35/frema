<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Booking;
use Auth;

class AuthController extends Controller
{
    // マイページを表示
    public function mypage(){
        // $user = Auth::user();
        // // 当日以降の予約情報を取得
        // $bookings = $user->bookings->where('date', '>=', now()->format('Y-m-d'));
        // // お気に入り店を取得
        // $stores = $user->favoriteStores();

        // return view('mypage', compact('user', 'stores', 'bookings'));
    }
}
