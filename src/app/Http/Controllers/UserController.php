<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Auth;
use FileIO;

class UserController extends Controller
{
    // ユーザー一覧を表示
    public function index(){
        $users = User::Paginate(10);

        return view('admin.users', compact('users'));
    }

    // ユーザーの削除
    public function destroy(int $user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        // 画面を更新
        $error = 'ユーザーを削除しました';
        return redirect()->route('admin.users')->with(compact('error'));
    }
}
