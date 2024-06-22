@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">ログイン(管理者)</h2>
  <form action="/admin/login" method="POST" class="form__login">
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
          @if (session('failure'))
          <li class="li__error">
            {{session('failure')}}
          </li>
          @endif
          @error('password')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__submit">ログインする</button>
    </div>
  </form>
</div>
@endsection