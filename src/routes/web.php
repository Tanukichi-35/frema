<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripeController;

include __DIR__ . '/admin.php';

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
])->name('top');;

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

// webhookによるセッション完了通知
Route::post('/webhooks',[
    StripeController::class, 'webhook'
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
    Route::post('/mypage/profile', [
        AuthController::class, 'restore'
    ]);

    // 商品の購入ページを表示
    Route::get('/purchase/{item_id}', [
        OrderController::class, 'purchase'
    ])->name('purchase');

    // 商品の購入
    Route::post('/purchase', [
        OrderController::class, 'create'
    ]);

    // コメントを投稿
    Route::post('/comment', [
        CommentController::class, 'create'
    ]);

    // 商品の出品ページを表示
    Route::get('/sell', [
        ItemController::class, 'sell'
    ])->name('sell');

    // 商品の出品登録
    Route::post('/sell', [
        ItemController::class, 'create'
    ]);

    // 住所の変更ページを表示
    Route::get('/address', [
        OrderController::class, 'address'
    ])->name('address');

    // 住所を変更
    Route::post('/address', [
        OrderController::class, 'restoreAddress'
    ]);

    // 支払い方法の変更ページを表示
    Route::get('/payment', [
        OrderController::class, 'payment'
    ])->name('payment');

    // 支払い方法を変更
    Route::post('/payment', [
        OrderController::class, 'restorePayment'
    ]);

    // 決済
    Route::post('/charge',[
        StripeController::class, 'charge'
    ])->name('stripe.charge');

    // 決済ページを表示
    Route::get('/checkout',[
        StripeController::class, 'checkout'
    ])->name('stripe.checkout');

    // 決済成功ページを表示
    Route::get('/checkout/success',[
        StripeController::class, 'success'
    ])->name('stripe.success');

    // 決済キャンセルページを表示
    Route::get('/checkout/cancel',[
        StripeController::class, 'cancel'
    ])->name('stripe.cancel');
});
