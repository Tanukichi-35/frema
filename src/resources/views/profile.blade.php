@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">プロフィール設定</h2>

  <form action="/mypage/profile" method="POST" class="form__restore" enctype="multipart/form-data">
    @csrf
    <div class="div__img">
      <img src="{{asset($user->img_url)}}">
      <input type="file" name="image"  accept=".jpg,.jpeg,.png,.svg" id="input__file" onchange="OnFileSelect(this)"/>
      <label class="label__select" for="input__file">画像を選択する</label>
    </div>
    <div class="div__error">
      <ul>
        @error('img_url')
        <li class="li__error">
          {{$message}}
        </li>
        @enderror
      </ul>
    </div>
    <div class="div__input-form">
      <div class="div__input">
        <label for="name">ユーザー名</label>
        <input type="text" name="name" class="input__name" id="name" value="{{$user->name}}" >
      </div>
      <div class="div__error">
        <ul>
          @error('name')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <label for="postcode">郵便番号</label>
        <input type="text" name="postcode" class="input__postcode" id="postcode" value="{{$user->addresses[0]->postcode}}" >
      </div>
      <div class="div__error">
        <ul>
          @error('postcode')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <label for="address">住所</label>
        <input type="address" name="address" class="input__address" id="address" value="{{$user->addresses[0]->address}}">
      </div>
      <div class="div__error">
        <ul>
          @error('address')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <label for="building">建物名</label>
        <input type="building" name="building" class="input__building" id="building" value="{{$user->addresses[0]->building}}">
      </div>
      <div class="div__error">
        <ul>
          @error('building')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__submit">更新する</button>
    </div>
  </form>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/setImage.js') }}"></script>
@endsection