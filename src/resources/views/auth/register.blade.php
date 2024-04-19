@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/loginForm.css') }}" />
@endsection

@section('content')
<div class="div__main shadow">
  <h2 class="h2__title">会員登録</h2>
  <form action="/register" method="POST" class="form__register">
    @csrf
    <div class="div__input-form">
      <div class="div__input">
        <label for="email">メールアドレス</label>
        <input type="text" name="email" class="input__mail" id="email" value="{{ old('email') }}" >
      </div>
      <div class="div__error">
        <ul>
          @error('email')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <div class="div__input">
        <label for="password">パスワード</label>
        <input type="password" name="password" class="input__password" id="password">
      </div>
      <div class="div__error">
        <ul>
          @error('password')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__submit">登録する</button>
      <a class="a__login" href="/login"><small>ログインはこちら</small></a>
    </div>
  </form>
</div>
@endsection