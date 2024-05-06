<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Auth;

class OrderController extends Controller
{
    // 注文情報を作成し表示
    public function purchase($item_id){
        if(session()->exists('order') && session()->get('order')->item_id == $item_id){
            $order = session()->get('order');
            // dd($order);
        }
        else{
            // 新しく注文を作成しセッションに保存
            $order = new Order();
            $order->init($item_id, Auth::user());
            session()->put('order', $order);
        }

        return view('purchase', compact('order'));
    }

    // 購入処理
    public function create($order, $address){

        // 登録されていない住所の場合登録する
        $user = User::find($order->user_id);
        $isExist = false;
        foreach ($user->addresses as $exist_address) {
            if($address->postcode == $exist_address->postcode
                && $address->address == $exist_address->address
                && $address->building == $exist_address->building){
                $isExist = true;
                $order->address_id = $exist_address->id;
                break;
            }
        }

        if(!$isExist){
            $address = Address::create([
                'user_id' => $address->user_id,
                'postcode' => $address->postcode,
                'address' => $address->address,
                'building' => $address->building,
            ]);
            $order->address_id = $address->id;
        }

        // 注文を作成
        Order::create([
            'item_id' => $order->item_id,
            'address_id' => $order->address_id,
            'user_id' => $order->user_id,
            'payment' => $order->payment,
            'status' => $order->status,
        ]);

        // return view('thanks');
    }

    // 住所変更画面を表示
    public function address(){
        if(session()->exists('address')){
            $address = session()->get('address');
        }
        else{
            $address = session()->get('order')->address;
        }

        return view('address', compact('address'));
    }

    // 住所を変更
    public function restoreAddress(AddressRequest $request){
        // 新しい住所をセッションに保存
        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->postcode = $request->postcode;
        $address->address = $request->address;
        $address->building = $request->building;
        session()->put('address', $address);

        // 画面を更新
        return redirect('/purchase/'.session()->get('order')->item_id)->with('message','配送先を変更しました');
    }

    // 支払い方法変更画面を表示
    public function payment(){
        $payment = session()->get('order')->payment;

        return view('payment', compact('payment'));
    }

    // 支払い方法を変更
    public function restorePayment(Request $request){
        // 新しい支払い方法をセッションに保存
        $order = session()->get('order');
        $order->payment = $request->payment;
        session()->put('order', $order);

        // 画面を更新
        return redirect('/purchase/'.session()->get('order')->item_id)->with('message','支払い方法を変更しました');
    }
}
