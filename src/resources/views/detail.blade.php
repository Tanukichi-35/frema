@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
  <div class="div__main">
    {{-- 商品画像 --}}
    <div class="div__left-contents">
      <img class="img__item-image" src="{{asset($item->img_url)}}" alt="画像が登録されていません">
    </div>

    {{-- 商品説明 --}}
    <div class="div__right-contents">
      <div class="div__title">
        <h2 class="h2__item-name">{{$item->name}}</h2>
        <small class="small__brand-name">ブランド名</small>
        <p class="p__price">¥{{$item->price}}</p>
      </div>
      <div class="div__function">
        <div class="div__like">
          <form method="POST">
          @csrf
            <input type="number" name="item_id" value="{{$item->id}}" hidden>
            @if(Auth::user())
              <img class="img__like" data-user_id={{Auth::user()->id}} data-item_id={{$item->id}} src="{{$item->checkLike()?asset('img/star_on.jpg'):asset('img/star_off.jpg')}}">
            @else
              <img class="img__like" data-user_id="0" data-item_id={{$item->id}} src="{{$item->checkLike()?asset('img/star_on.jpg'):asset('img/star_off.jpg')}}">
            @endif
          </form>
          {{-- <img src="{{asset('img/star_off.jpg')}}" alt="" class="img__like"> --}}
          <small class="small__like-number">{{$item->getLikeNumber()}}</small>
        </div>
        <div class="div__comment">
          <img src="{{asset('img/comment.jpg')}}" alt="" class="img__comment">
          <small class="small__comment-number">{{$item->getCommentNumber()}}</small>
        </div>
      </div>
      {{-- 購入フォーム --}}
      <div class="div__purchase-form">
        <a href="/purchase/{{$item->id}}" class="a__purchase">購入する</a>
        <div class="div__item-description">
          <h3 class="h3__description-title">商品説明</h3>
          <p class="p__description">{{$item->description}}</p>
        </div>
        <div class="div__item-information">
          <h3 class="h3__information-title">商品の情報</h3>
          <div class="div__category">
            <p class="p__category">カテゴリー</p>
            <div class="div__category-tag">
              @foreach ($item->itemCategories as $itemCategory)
                  <small class="small__category">{{$itemCategory->category->name}}</small>
              @endforeach
            </div>
          </div>
          <div class="div__condition">
            <p class="p__condition">商品の状態</p>
            <div class="div__condition-tag">
                <small class="small__condition">{{$item->condition->name}}</small>
            </div>
          </div>
        </div>
      </div>
      {{-- コメントフォーム --}}
      <div class="div__comment-form" hidden>
        <div class="div__show-comment">
          @foreach ($item->comments as $comment)
            <div class="div__comment-user" @if($comment->isOwner()) style="justify-content:end" @endif>
              <img class="img__user-img" src="{{asset($comment->user->img_url)}}" alt="">
              <p class="p__user-name">{{$comment->user->name}}</p>
            </div>
            <p class="p__comment">{{$comment->comment}}</p>
          @endforeach
        </div>
        <div class="div__submit-comment">
          <form action="{{'/detail/'.$item->id.'/comment'}}" method="POST" class="form__comment">
          @csrf
            <label class="label__comment" for="comment">商品へのコメント</label>
            <input type="number" name="item_id" value="{{$item->id}}" hidden>
            <textarea name="comment" id="comment" class="textarea__comment" rows="5"></textarea>
            <button class="button__comment-submit">コメントを送信する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/detail.js')}}"></script>
  <script src="{{ asset('js/function.js')}}"></script>
@endsection