@extends('layout')

@section('content')
    <div class="container mt-3">
        <dl class="row">
            <dt class="col-md-3 py-3">アイコン</dt>
            <dd class="col-md-9 py-3">{{ $user->avatar_image }}</dd>
            <dt class="col-md-3 py-3">名前</dt>
            <dd class="col-md-9 py-3">{{ $user->name }}</dd>
            <dt class="col-md-3 py-3">メールアドレス</dt>
            <dd class="col-md-9 py-3">{{ $user->email }}</dd>
            <dt class="col-md-3 py-3">年齢</dt>
            <dd class="col-md-9 py-3">{{ $user->age }}</dd>
            <dt class="col-md-3 py-3">性別</dt>
            <dd class="col-md-9 py-3">{{ $user->sex }}</dd>
            <dt class="col-md-3 py-3">自己紹介</dt>
            <dd class="col-md-9 py-3">{{ $user->profile }}</dd>
        </dl>
        <a href="{{ route('users.edit', ['user' => $user]) }}">
            <button class="btn btn-outline-warning w-100 mb-3">編集する</button>
        </a>
        <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger w-100 mb-3" onclick="return confirm('削除して宜しいですか？')">削除する</button>
        </form>
    </div>
@endsection