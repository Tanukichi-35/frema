@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/users.css') }}" />
  @endsection

@section('content')
<div class="div__main">
  <h2 class="h2__title">登録ユーザー一覧</h2>
  <div class="div__table-content">

    {{ $users->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__name">ユーザー名</th>
        <th class="th__email">メールアドレス</th>
        <th class="th__created-at">登録日</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($users as $user)
      <tr class="tr__contents">
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at->format('Y/m/d')}}</td>
        <td>
          <div class="div__button">
            <a class="a__comment" href="/admin/comments/{{$user->id}}">コメント一覧</a>
            <form action="/admin/user/{{$user->id}}" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$user->id}}" hidden>
              <button class="button__delete">削除</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection
