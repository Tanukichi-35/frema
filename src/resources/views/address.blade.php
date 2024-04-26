@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">住所の変更</h2>
  <form action="/register" method="POST" class="form__register">
    @csrf
    <div class="div__input-form">
      <div class="div__input">
        <label for="postcode">郵便番号</label>
        <input type="text" name="postcode" class="input__postcode" id="postcode" value="{{$address->postcode}}">
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
        <input type="address" name="address" class="input__address" id="address" value="{{$address->address}}">
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
        <input type="building" name="building" class="input__building" id="building" value="{{$address->building}}">
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