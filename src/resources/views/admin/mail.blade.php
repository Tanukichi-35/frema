@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/inputForm.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/mailForm.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="div__main">

  {{-- メール送信フォーム --}}
  <div class="div__input-form">
    <div class="div__header">
      <h3 class="h3__input-form">お知らせメール</h3>
    </div>
    <form action="/admin/mail" method="POST" class="form__input-form" enctype="multipart/form-data">
      @csrf
      <table class="table__input-form">
        <tr>
          <th><label for="input__to">送信先</label></th>
          <td>
            <select name="to" id="input__to">
              <option value="0">全員</option>
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}（{{$user->email}}）</option>
              @endforeach
            </select>
            <div class="div__error">
              <ul>
                @error('name')
                <li class="li__error">
                  {{$message}}
                </li>
                @enderror
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <th><label for="input__subject">件名</label></th>
          <td>
            <input type="text" name="subject" id="input__subject" value="{{old('subject')}}">
          </td>
        </tr>
        <tr>
          <th><label for="input__text">本文</label></th>
          <td>
            <textarea name="text" class="textarea__text" id="input__text" cols="30" rows="20">{{old('text')}}</textarea>
          </td>
        </tr>
      </table>
      <div class="div__submit">
        <button class="button__submit">送信</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('script')
  <script src="{{ asset('js/inputForm.js') }}"></script>
@endsection