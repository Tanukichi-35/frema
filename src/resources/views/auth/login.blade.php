@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/loginForm.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">ログイン</h2>
  <form action="/login" method="POST" class="form__login">
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
      <button class="button__submit">ログインする</button>
      <a class="a__register" href="/register"><small>会員登録はこちら</small></a>
    </div>
  </form>
</div>
@endsection