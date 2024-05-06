@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
@endsection

@section('content')
  <div class="div__main">
    {{-- 商品 --}}
    <div class="div__item">
      <img class="img__item-image" src="{{asset($order->item->img_url)}}" alt="画像が登録されていません">
      <div class="div__item-info">
        <h3 class="h3__item-name">{{$order->item->name}}</h3>
        <p class="p__item-price">{{'¥'.number_format($order->item->price)}}</p>
      </div>
    </div>

    {{-- 支払い方法 --}}
    <div class="div__payment">
      <h3 class="h3__payment">支払い方法</h3>
      <a href="/payment" class="a__payment">変更する</a>
    </div>

    {{-- 配送先 --}}
    <div class="div__delivery">
      <h3 class="h3__delivery">配送先</h3>
      <a href="/address" class="a__delivery">変更する</a>
    </div>

    {{-- まとめ --}}
    <div class="div__summary">
      <table class="table__summary">
        <tr class="tr__item-price">
          <th>商品代金</th>
          <td>¥{{$order->item->price}}</td>
        </tr>
        <tr class="tr__payment-price">
          <th>支払い金額</th>
          <td>{{'¥'.number_format($order->item->price)}}</td>
        </tr>
        <tr class="tr__payment-method">
          <th>支払い方法</th>
          <td>{{$order->getPayment()}}</td>
        </tr>
      </table>
    </div>

    {{-- 購入 --}}
    <div class="div__purchase">
      <a href="/checkout" class="a__purchase"  target="_blank">購入する</a>
    </div>
  </div>
@endsection