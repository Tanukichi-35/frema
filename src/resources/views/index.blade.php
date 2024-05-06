@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <input id="input__recommend" type="radio" name="tab_btn" checked>
	<input id="input__mylist" type="radio" name="tab_btn">

	<div class="div__tab">
		<label id="label__recommend" for="input__recommend">おすすめ</label>
		<label id="label__mylist" for="input__mylist">マイリスト</label>
	</div>

	<div class="div__panel">
    {{-- おすすめ --}}
		<div id="div__recommend">
      <div class="div__item-list">
        @foreach ($items as $item)
        <div class="div__item-info">
          <a class="a__item" href="/detail/{{$item->id}}">
            <div class="div__image" style="background-image: url({{asset($item->img_url)}});">
              @if ($item->isSold())
                  <div class="div__gray">
                    <p class="p__sold">売り切れ</p>
                  </div>
              @endif
            </div>
            <p href="/detail/{{$item->id}}" class="p__item-name">{{$item->name}}</p>
          </a>
        </div>
        @endforeach
      </div>
		</div>
    {{-- マイリスト --}}
    @isset($favoriteItems)
		<div id="div__mylist">
      <div class="div__item-list">
        @foreach ($favoriteItems as $item)
        <div class="div__item-info">
          <a class="a__item" href="/detail/{{$item->id}}">
            <div class="div__image" style="background-image: url({{asset($item->img_url)}});">
              @if ($item->isSold())
                  <div class="div__gray">
                    <p class="p__sold">売り切れ</p>
                  </div>
              @endif
            </div>
            <p href="/detail/{{$item->id}}" class="p__item-name">{{$item->name}}</p>
          </a>
        </div>
        @endforeach
      </div>
		</div>
    @endisset
	</div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/index.js') }}"></script>
@endsection