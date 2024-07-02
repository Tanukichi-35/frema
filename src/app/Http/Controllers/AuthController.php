<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use App\Models\User;
use Auth;
use FileIO;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    // マイページを表示
    public function mypage(){
        $user = Auth::user();
        // 出品した商品を取得
        $exhibitedItems = $user->items;

        // 購入した商品を取得
        $purchasedItems = $user->purchasedItems();

        return view('mypage', compact('user', 'exhibitedItems', 'purchasedItems'));
    }

    // プロフィール編集画面を表示
    public function profile(){
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    // プロフィールを更新
    public function restore(ProfileRequest $request){
        $user = Auth::user();

        // 画像をアップロード
        $imgPath = $user->img_url;
        if(!is_null($request->file('image'))){
            FileIO::deleteImageFile($user->img_url);
            $imgPath = FileIO::uploadImageFile($request->file('image'));
        }

        // ユーザー情報の更新
        $user->update([
            'name' => $request->name,
            'img_url' => $imgPath
        ]);

        if(isEmpty($user->addresses)){
            // 住所の作成
            Address::create([
                'user_id' => $user->id,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
        }
        else{
            // 住所の更新
            $user->addresses[0]->update([
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
        }

        // 画面を更新
        $message = '登録情報を更新しました';
        return redirect()->route('profile')->with(compact('user', 'message'));
    }
}
