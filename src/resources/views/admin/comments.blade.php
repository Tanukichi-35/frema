@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listTable.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  @endsection

@section('content')
<div class="div__main">
  <button class="button__back" onclick="goBackPage()">&lt; 戻る</button>
  <h2 class="h2__title">コメント一覧（{{$user->name}}）</h2>
  <div class="div__table-content">
    {{ $comments->links() }}
    <table class="table__list">
      <tr class="tr__header">
        <th class="th__date">投稿日</th>
        <th class="th__item">アイテム名</th>
        <th class="th__comment">コメント</th>
        <th class="th__function"></th>
      </tr>
      @foreach ($comments as $comment)
      <tr class="tr__contents">
        <td>{{$comment->created_at->format('y/m/d')}}</td>
        <td>{{$comment->item->name}}</td>
        <td>{{$comment->comment}}</td>
        <td>
          <div class="div__button">
            <form action="/admin/comment/{{$comment->id}}" method="POST" class="form__delete">
              @csrf
              @method('DELETE')
              <input type="text" name="id" value="{{$comment->id}}" hidden>
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