<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use Auth;

class CommentController extends Controller
{
    // コメントページを表示
    public function comment($item_id){
        $item = Item::find($item_id);

        return view('comment', compact('item'));
    }

    // コメントを投稿
    public function create(Request $request){
        if(Auth::user()) {
            $user_id = Auth::user()->id;
            $store_id = $request->store_id;
            if(Review::checkReview($user_id, $store_id)){
            return redirect('/detail/'.$store_id)->with('error','既にレビューを投稿済みです。');
            }
            else{
            // 新しくレビューアイテムを作成
            Review::create([
                'user_id' => $user_id,
                'store_id' => $store_id,
                'rate' => $request->rate,
                'comment' => $request->comment,
            ]);
            }

            // 画面を更新
            return redirect('/detail/'.$store_id)->with('message','レビューを投稿いただきありがとうございます。');
        }
    }
}
