@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="div__main">

  <div class="div__main-top">
  <div class="div__profile">
    <img class="img__profile" src="{{asset($user->img_url)}}" alt="">
    <h2 class="h2__profile">{{$user->name}}</h2>
  </div>
    <a class="a__profile" href="/mypage/profile">プロフィールを編集</a>
  </div>

  <input id="input__recommend" type="radio" name="tab_btn" checked>
	<input id="input__mylist" type="radio" name="tab_btn">

	<div class="div__tab">
		<label id="label__recommend" for="input__recommend">出品した商品</label>
		<label id="label__mylist" for="input__mylist">購入した商品</label>
	</div>

	<div class="div__panel">
    {{-- 出品した商品 --}}
		<div id="div__recommend">
      <div class="div__item-list">
        @foreach ($exhibitedItems as $item)
        <div class="div__item-info">
          <div class="div__image" style="background-image: url({{asset($item->img_url)}});"></div>
          <a href="/detail/{{$item->id}}" class="a__item-name">{{$item->name}}</a>
        </div>
        @endforeach
      </div>
		</div>
    {{-- 購入した商品 --}}
		<div id="div__mylist">
      <div class="div__item-list">
        @foreach ($purchasedItems as $item)
        <div class="div__item-info">
          <div class="div__image" style="background-image: url({{asset($item->img_url)}});"></div>
          <a href="/detail/{{$item->id}}" class="a__item-name">{{$item->name}}</a>
        </div>
        @endforeach
      </div>
		</div>
	</div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/index.js') }}"></script>
@endsection