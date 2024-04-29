@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sell.css') }}" />
  <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css">
@endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">商品の出品</h2>

  <form action="/sell" method="POST" class="form__restore" enctype="multipart/form-data">
    @csrf
    <div class="div__img">
      <label class="label__image">商品画像</label>
      <div class="div__file">
        <img src="">
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.svg" id="input__file" onchange="OnFileSelect(this)"/>
        <label for="input__file">画像を選択する</label>
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
    </div>

    <div class="div__input-form">
      <h3 class="h3__input">商品の詳細</h3>
      <div class="div__detail">
        <div class="div__input">
          <label for="cateory">カテゴリー</label>
          <select name="category_id[]" class="select__search-category" id="select__search-category" multiple>
            @foreach (Category::All() as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="div__error">
          <ul>
            @error('category_id')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
        <div class="div__input">
          <label for="condition">商品の状態</label>
          <select name="condition_id" class="select__search-condition" id="select__search-condition">
            @foreach (Condition::All() as $condition)
            <option value="{{$condition->id}}" @if(old('condition_id') == $condition->id) selected @endif>{{$condition->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="div__error">
          <ul>
            @error('condition')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
      </div>

      <h3 class="h3__input">商品名と説明</h3>
      <div class="div__name">
        <div class="div__input">
          <label for="name">商品名</label>
          <input type="text" name="name" class="input__name" id="name" value="{{old('name')}}">
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
          <label for="description">説明</label>
          <textarea name="description" id="description" class="textarea__description" rows="5">{{old('description')}}</textarea>
        </div>
        <div class="div__error">
          <ul>
            @error('description')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
      </div>

      <h3 class="h3__input">販売価格</h3>
      <div class="div__price">
        <div class="div__input">
          <label for="price">販売価格</label>
          <input type="text" name="price" class="input__price" id="price" @if(is_null(old('price'))) value="¥0" @else value="{{old('price')}}" @endif>
        </div>
        <div class="div__error">
          <ul>
            @error('price')
            <li class="li__error">
              {{$message}}
            </li>
            @enderror
          </ul>
        </div>
      </div>
    </div>

    <button class="button__submit" onClick="submit();">出品する</button>
  </form>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/setImage.js') }}"></script>
  <script src="{{ asset('js/multiSelect.js') }}"></script>
  <script src="{{ asset('js/inputPrice.js') }}"></script>
  <script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>
@endsection