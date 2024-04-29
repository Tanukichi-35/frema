@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">支払い方法の変更</h2>
  <form action="/payment" method="POST" class="form__register">
    @csrf
    <div class="div__input-form">
      <div class="div__input">
        <label for="payment">支払い方法</label>
        <select name="payment" class="select__payment"  id="payment">
          <option value="0" @if($payment == 0) selected @endif>クレジットカード</option>
          <option value="1" @if($payment == 1) selected @endif>コンビニ払い</option>
          <option value="2" @if($payment == 2) selected @endif>銀行振込</option>
        </select>
      </div>
      <div class="div__error">
        <ul>
          @error('payment')
          <li class="li__error">
            {{$message}}
          </li>
          @enderror
        </ul>
      </div>
      <button class="button__submit">変更する</button>
    </div>
  </form>
</div>
@endsection