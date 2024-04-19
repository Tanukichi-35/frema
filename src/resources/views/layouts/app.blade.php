<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Frema</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Noto+Sans+JP&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>

  {{-- message --}}
  @if(session('message'))
  <div id="div__flash-message">{{session('message')}}</div>
  @endif

  {{-- error message --}}
  @if(session('error'))
  <div id="div__flash-error">{{session('error')}}</div>
  @endif

  <header>
    <div class="div__header">
      <img class="img__logo" src="{{asset("img/logo.svg")}}" alt="">
      <form class="form__search" action="/serach" method="POST" @disabled(true)>
        @csrf
        <input class="input__search" type="text" name="keyword" id="" placeholder="なにをお探しですか？">
      </form>
      <div class="div__menu">
        <div class="div__link">
          <a href="/login" class="a__login">ログイン</a>
          <a href="/login" class="a__login">会員登録</a>
          <a href="/mypage" class="a__mypage">マイページ</a>
        </div>
        <form class="form__logout" action="/logout" method="POST">
          @csrf
          <button>ログアウト</button>
        </form>
        <a href="/sell" class="a__sell">出品</a>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('script')
</body>

</html>