@extends('layout')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="text-center">詳細</h2>
        <div class="form-group">
            <label for="place">投稿者</label>
            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ $map->user->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="place">アイコン</label>
            @if ($map->user->avatar_image)
                <dd class="col-md-9 py-3"><img src="{{ $map->user->avatar_image }}" class="rounded-circle w-25"></dd>
            @else
                <dd class="col-md-9 py-3"><img src="{{ asset("noimage.png") }}" class="rounded-circle w-25"></dd>
            @endif
        </div>
        <div class="col-md-6">
            <label for="place">性別</label>
            <input type="text" name="user_avatar" id="user_avatar" class="form-control" value="{{ $map->user->sex }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="place">年齢</label>
            <input type="text" name="user_avatar" id="user_avatar" class="form-control" value="{{ $map->user->age }}" disabled>
        </div>

        <div class="form-group">
            <label for="place">場所</label>
            <input type="text" name="place" id="place" class="form-control" value="{{ $map->place }}" disabled>
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $map->title }}" disabled>
        </div>
        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content" id="content" rows="3" class="form-control" disabled>{{ $map->content }}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="date">日付</label>
            <input type="text" id="date" name="date" class="form-control date" value="{{ $map->date }}" disabled>
        </div>
        <div class="form-group col-md-6 col-md-offset-6">
            <label for="lat">緯度</label>
            <input type="text" id="lat" name="lat" class="form-control" value="{{ $map->lat }}" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="lng">経度</label>
            <input type="text" id="lng" name="lng" class="form-control" value="{{ $map->lng }}" disabled>
        </div>
        <!-- 投稿者にのみ編集や削除ボタン表示 -->
        @if($user_id === $map->user_id)
            <a href="{{ route('map.edit', ['map' => $map]) }}">
                <button class="btn btn-outline-primary w-50 mb-2">編集</button>
            </a>
            @component('components.delete-btn')
            @slot('name', 'map')
            @slot('id', $map->id)
            @endcomponent
        @endif
</div>
@endsection

@section('scripts')
<!-- flatpickrライブラリ読込み -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
flatpickr(document.getElementsByClassName('date'), {
    locale: 'ja',
    dateFormat: 'Y/m/d',
    minDate: new Date()
});
</script>
    
@endsection