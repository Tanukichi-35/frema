<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Order;
use App\Models\Item;
use Auth;

class OrderController extends Controller
{
    // 注文情報を作成し表示
    public function purchase($item_id){
        // 新しく注文を作成しセッションに保存
        $order = new Order();
        $order->init($item_id, Auth::user());
        session()->put('order', $order);

        return view('purchase', compact('order'));
    }

    // 住所変更画面を表示
    public function address($order_id){
        $order = session()->get('order');
        $address = $order->address;

        return view('address', compact('address'));
    }

    // 住所を変更
    public function restoreAddress(AddressRequest $request){
        $address = Order::find($address_id);

        // 住所の更新
        $address->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building
        ]);

        // 画面を更新
        $message = '登録情報を更新しました';
        return redirect()->route('profile')->with(compact('user', 'message'));
    }
}
