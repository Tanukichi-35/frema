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
  <header>
    <div class="div__header">
      <a class="a__logo" href="/">
        <img class="img__logo" src="{{asset("img/logo.svg")}}" alt="">
      </a>
      <form class="form__search" action="/search" method="GET" @disabled(true)>
        @csrf
        <input class="input__search" type="text" name="keyword" id="" placeholder="なにをお探しですか？" @if (isset( $request )) value="{{$request['keyword']}}"@endif>
      </form>
      <div class="div__menu">
        <a href="/" class="a__toppage">トップページ</a>
        @if (Auth::guard('admins')->check())
          <a href="/admin/mail" class="a__mail">メール送信</a>
          <form class="form__logout" action="/logout" method="POST">
            @csrf
            <button>ログアウト</button>
          </form>
        @elseif (Auth::check())
          <a href="/mypage" class="a__mypage">マイページ</a>
          <form class="form__logout" action="/logout" method="POST">
            @csrf
            <button>ログアウト</button>
          </form>
        @else
          <a href="/login" class="a__login">ログイン</a>
          <a href="/register" class="a__register">会員登録</a>
        @endif
        <a href="/sell" class="a__sell">出品</a>
      </div>
    </div>
  </header>

  {{-- message --}}
  @if(session('message'))
  <div id="div__flash-message">{{session('message')}}</div>
  @endif

  {{-- error message --}}
  @if(session('error'))
  <div id="div__flash-error">{{session('error')}}</div>
  @endif

  <main>
    @yield('content')
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('script')
</body>

</html>