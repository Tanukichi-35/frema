<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|（管理者用）--------------------------------------------------------------------------
|
*/

// ログインページの表示
Route::get('/admin/login', [
    AdminController::class, 'entrance'
])->name('admin.login');

// ログイン
Route::post('/admin/login', [
    AdminController::class, 'login'
]);

// 管理者認証
Route::prefix('admin')->middleware('auth.admins:admins')->group(function () {

    // ログアウト
    Route::post('logout', [
        AdminController::class, 'logout'
    ]);

    // ユーザー一覧ページを開く
    Route::get('users', [
        UserController::class, 'index'
    ])->name('admin.users');

    // ユーザーを削除
    Route::delete('user/{user_id}', [
        UserController::class, 'destroy'
    ]);

    // 口コミ一覧ページを表示
    Route::get('comments/{user_id}', [
        CommentController::class, 'index'
    ])->name('admin.comments');

    // 口コミを削除
    Route::delete('comment/{comment_id}', [
        CommentController::class, 'destroy'
    ]);

    // // お知らせメール送信フォームの表示
    // Route::get('mail', [
    //     MailController::class, 'mail'
    // ])->name('admin.mail');

    // // お知らせメールを送信
    // Route::post('mail', [
    //     MailController::class, 'send'
    // ]);
});