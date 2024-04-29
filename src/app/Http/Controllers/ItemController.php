<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemCategory;
use App\Models\Like;
use Auth;
use FileIO;
use Str;

class ItemController extends Controller
{
    // 商品一覧ページを表示
    public function index(){
        // 全ての商品を取得
        $items = Item::All();

        // お気に入りの商品を取得
        if(Auth::check()){
            $favoriteItems = Auth::user()->favoriteItems();
        }
        else{
            return view('index', compact('items'));
        }

        return view('index', compact('items', 'favoriteItems'));
    }

    // 商品詳細ページを表示
    public function detail($item_id){
        // IDが一致する商品を取得
        // $item = Item::getItem($item_id);
        $item = Item::find($item_id);
        // 商品のお気に入りを取得
        $likes = $item->likes;
        // 商品のレビューを取得
        $comments = $item->comments;

        return view('detail', compact('item', 'likes', 'comments'));
    }

    // 商品の検索を実施
    public function search(Request $request){
        // 商品名とカテゴリーで検索
        $categories = Category::CategorySearch($request->keyword)->get();
        $item_categories = ItemCategory::CategorySearch($categories)->get();
        $items = Item::ItemSearch($request->keyword, $item_categories)->get();

        // お気に入りの商品を取得
        if(Auth::check()){
            $favoriteItems = Auth::user()->favoriteItems();
        }
        else{
            return view('index', compact('items', 'request'));
        }

        return view('index', compact('items', 'favoriteItems', 'request'));
    }

    // 商品の出品ページを表示
    public function sell(){
        return view('sell');
    }

    // 商品の出品登録
    public function create(ItemRequest $request){
        // dd($request);

        // 画像をアップロード
        $img_url = null;
        if(!is_null($request->file('image'))){
            $img_url = FileIO::uploadImageFile($request->file('image'));
        }

        // 商品を登録
        $item = Item::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'condition_id' => $request->condition_id,
            'price' => $request->price,
            'img_url' => $img_url,
        ]);

        // カテゴリーを登録
        foreach ($request->category_id as $category_id) {
            $category = ItemCategory::create([
                'category_id' => $category_id,
                'item_id' => $item->id,
            ]);
        }

        // 画面を更新
        $message = '商品を登録しました';
        return redirect()->route('mypage')->with(compact('message'));
    }

    // // 商品情報の更新ページの表示
    // public function edit($item_id){
    //     // IDが一致する商品を取得
    //     $item = Auth::guard('managers')->user()->items->find($item_id);

    //     if(is_null($item)){
    //         $error = '商品情報が見つかりません';
    //         return redirect()->route('manager.items')->with(compact('error'));
    //     }
    //     return view('manager.itemEditor', compact('item'));
    // }

    // // 商品情報の更新
    // public function restore(ItemRequest $request){
    //     $item = Item::find($request->id);

    //     // 画像をアップロード
    //     $imagePath = $item->imageURL;
    //     if(!is_null($request->file('image'))){
    //         FileIO::deleteImageFile($item->imageURL);
    //         $imagePath = FileIO::uploadImageFile($request->file('image'));
    //     }

    //     // 商品情報の更新
    //     $item->update([
    //         'name' => !is_null($request->name)?$request->name:$item->name,
    //         'area_id' => $request->area_id,
    //         'genre_id' => $request->genre_id,
    //         'description' => !is_null($request->description)?$request->description:$item->description,
    //         'imageURL' => $imagePath
    //     ]);

    //     // 画面を更新
    //     // return redirect()->route('manager.items');
    //     // return back()->withInput();
    //     $message = '登録情報を更新しました';
    //     return redirect()->route('manager.items')->with(compact('message'));
    // }

    // // 商品の削除
    // public function destroy(Request $request){
    //     $item = Item::find($request->id);
    //     // 紐づくデータを同時に削除
    //     foreach ($item->bookings as $booking)
    //         $booking->delete();
    //     foreach ($item->favorites as $favorite)
    //         $favorite->delete();
    //     $item->delete();

    //     // 画面を更新
    //     // return redirect()->route('manager.items');
    //     $error = '登録情報を削除しました';
    //     return redirect()->route('manager.items')->with(compact('error'));
    // }

    // // 商品の一括削除
    // public function batchDestroy(Request $request){
    //     foreach (Item::all() as $item) {
    //         if(!is_null($request->input($item->id))){
    //             // 紐づくデータを同時に削除
    //             foreach ($item->bookings as $booking)
    //                 $booking->delete();
    //             foreach ($item->favorites as $favorite)
    //                 $favorite->delete();
    //             $item->delete();
    //         }
    //     };

    //     // 画面を更新
    //     // return redirect()->route('manager.items');
    //     $error = '登録情報を削除しました';
    //     return redirect()->route('manager.items')->with(compact('error'));
    // }
}
