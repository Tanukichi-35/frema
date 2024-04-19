<?php

use Illuminate\Support\Facades\Route;

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

// 会員認証
Route::middleware('verified')->group(function () {

    // マイページを表示
    Route::get('/mypage', [
        AuthController::class, 'mypage'
    ])->name('mypage');;

});
