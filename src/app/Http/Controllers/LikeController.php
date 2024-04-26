<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Auth;

class LikeController extends Controller
{
    // お気に入り追加
    public function create(Request $request){
        if(Auth::user()) {
            // 新しくお気に入りアイテムを作成
            Like::create([
              'user_id' => Auth::user()->id,
              'item_id' => $request->item_id,
            ]);
        }
        else {
            session([Item::find($request->item_id)->name => true]);
        }

        // 画面を更新
        return back()->withInput();
    }

    // お気に入り削除
    public function destroy(Request $request){
        if(Auth::user()){
            // 該当のお気に入りアイテムを削除
            $like = Like::getLike(Auth::user()->id, $request->item_id);
            $like->delete();
          }
        else {
            session()->forget(Item::find($request->item_id)->name);
        }

        // 画面を更新
        return back()->withInput();
    }
}
