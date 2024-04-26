<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップページを表示
Route::get('/', [
    ItemController::class, 'index'
]);

// 商品の検索を実行
Route::get('/search', [
    ItemController::class, 'search'
]);

// 商品の詳細ページを表示
Route::get('/detail/{item_id}', [
    ItemController::class, 'detail'
]);

// お気に入り追加
Route::post('/likeOn', [
    LikeController::class, 'create'
]);

// お気に入り削除
Route::post('/likeOff', [
    LikeController::class, 'destroy'
]);

// 会員認証
Route::middleware('auth')->group(function () {

    // マイページを表示
    Route::get('/mypage', [
        AuthController::class, 'mypage'
    ])->name('mypage');

    // プロフィール編集画面を表示
    Route::get('/mypage/profile', [
        AuthController::class, 'profile'
    ])->name('profile');

    // プロフィールを更新
    Route::post('/mypage/profile/restore', [
        AuthController::class, 'restore'
    ]);

    // 商品の購入ページを表示
    Route::get('/purchase/{item_id}', [
        OrderController::class, 'purchase'
    ])->name('purchase');

    // 商品の購入
    Route::post('/purchase/{item_id}', [
        OrderController::class, 'create'
    ]);

    // コメントを投稿
    Route::post('/detail/{item_id}/comment', [
        CommentController::class, 'create'
    ]);

    // 商品の出品ページを表示
    Route::get('/sell', [
        ItemController::class, 'sell'
    ])->name('sell');

    // 商品の出品登録
    Route::post('/sell/register', [
        ItemController::class, 'create'
    ]);

    // 住所の変更ページを表示
    Route::get('/purchase/address/{order_id}', [
        OrderController::class, 'address'
    ])->name('address');

    // // 住所を変更
    // Route::post('/purchase/address/{order_id}', [
    //     OrderController::class, 'restoreAddress'
    // ]);

});
