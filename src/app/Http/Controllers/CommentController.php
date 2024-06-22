<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
            $item_id = $request->item_id;
            if(Comment::checkComment($user_id, $item_id)){
                return back()->with('error','既にコメントを投稿済みです。');
            }
            else{
            // 新しくコメントアイテムを作成
                Comment::create([
                    'user_id' => $user_id,
                    'item_id' => $item_id,
                    'comment' => $request->comment,
                ]);
            }

            // 画面を更新
            return back()->with('message','コメントを投稿いただきありがとうございます。');
        }
        else{
            return back()->with('error','コメントを投稿するにはログインしてください。');
        }
    }

    // コメント一覧を表示
    public function index(int $user_id){
        $user = User::find($user_id);
        $comments = Comment::where('user_id', '=', $user_id)->paginate(10);

        return view('admin.comments', compact('user', 'comments'));
    }

    // コメントの削除
    public function destroy(int $comment_id)
    {
        $comment = Comment::find($comment_id);
        $user_id = $comment->user_id;
        $comment->delete();

        // 画面を更新
        $error = 'コメントを削除しました';
        return redirect()->route('admin.comments',['user_id' => $user_id])->with(compact('error'));
    }
}
