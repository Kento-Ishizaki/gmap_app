@extends('layout')

@section('content')
    <div class="container mt-3">
        <h2 class="text-center">ユーザー編集</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <dl class="row">
                <dt class="col-md-3 py-3">
                    @if ($user->avatar_image)
                        <img src="{{ $user->avatar_image }}" class="rounded-circle w-25">
                    @else
                        <img src="{{ asset("noimage.png") }}" class="rounded-circle w-25">
                    @endif
                </dt>
                <dd class="col-md-9 py-3">
                    <input type="file" name="avatar_image" id="avatar_image" class="form-group" accept="image/*">
                </dd>
                <dt class="col-md-3 py-3"><label for="name">名前　※必須</label></dt>
                <dd class="col-md-9 py-3">
                    <input type="text" name="name" id="name" class="form-group w-75 py-1" value="{{ old('name', $user->name) }}">
                </dd>
                <dt class="col-md-3 py-3"><label for="email">メールアドレス　※必須</label></dt>
                <dd class="col-md-9 py-3">
                    <input type="email" name="email" id="email" class="form-group w-75 py-1" value="{{ old('email', $user->email) }}">
                </dd>
                <dt class="col-md-3 py-3"><label for="age">年齢</label></dt>
                <dd class="col-md-9 py-3">
                    <input type="number" name="age" id="age" class="form-group w-75 py-1" value="{{ old('age', $user->age) }}">
                </dd>
                <dt class="col-md-3 py-3"><label for="sex">性別　※必須</label></dt>
                <dd class="col-md-9 py-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="sex1" value="男性" {{ $user->sex === '男性' ? 'checked' : '' }}>
                        <label class="form-check-label" for="sex1">男性</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="sex2" value="女性" {{ $user->sex === '女性' ? 'checked' : '' }}>
                        <label class="form-check-label" for="sex2">女性</label>
                    </div>
                </dd>
                <dt class="col-md-3 py-3"><label for="profile">自己紹介</label></dt>
                <dd class="col-md-9 py-3">
                    <textarea name="profile" id=profile class="form-group w-100 py-1" rows="3">{{ old('profile', $user->profile) }}</textarea>
                </dd>
            </dl>
        </div>
        <button type="submit" name="submit" class="btn btn-outline-warning w-100 mb-3">送信</button>
        <button type="button" class="btn btn-outline-danger w-100 mb-3" onclick="history.back()">戻る</button>
        </form>
    </div>
@endsection