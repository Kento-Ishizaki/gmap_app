@extends('layout')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="text-center">編集</h2>
    <form action="{{ route('map.update', ['map' => $map]) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="modal-body">
            <div class="form-group">
                <label for="place">場所</label>
                <input type="text" name="place" id="place" class="form-control" value="{{ $map->place }}">
            </div>
            <div class="form-group">
                <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $map->title }}">
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea name="content" id="content" rows="3" class="form-control">{{ $map->content }}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="date">日付</label>
                <input type="text" id="date" name="date" class="form-control date bg-light" value="{{ $map->date }}">
            </div>
            <div class="form-group col-md-6 col-md-offset-6">
                <label for="lat">緯度</label>
                <input type="text" id="lat" name="lat" class="form-control" value="{{ $map->lat }}">
            </div>
            <div class="form-group col-md-6">
                <label for="lng">経度</label>
                <input type="text" id="lng" name="lng" class="form-control" value="{{ $map->lng }}">
            </div>
            <button type="submit" class="btn btn-outline-primary w-50 mb-2">送信</button>
        </div>
    </form>
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