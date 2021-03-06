@extends('layout')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container mt-3 text-center">
    <h2>詳細</h2>
    @if ($map->user->avatar_image)
    <dd class="col-md-9 w-25"><img src="{{ $map->user->avatar_image }}" class="rounded-circle w-25"></dd>
    @else
    <dd class="col-md-9 w-25"><img src="{{ asset("noimage.png") }}" class="rounded-circle w-25"></dd>
    @endif
    <table class="table table-striped mb-4">
        <thead>
            <tr>
                <th scope="col">項目</th>
                <th scope="col">内容</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>投稿者名</td>
                <td><a href="{{ route('users.show', ['user' => $map->user]) }}">{{ $map->user->name }}</a></td>
            </tr>
            <tr>
                <td>性別</td>
                <td>{{ $map->user->sex }}</td>
            </tr>
            <tr>
                <td>年齢</td>
                <td>{{ $map->user->age }}</td>
            </tr>
            <tr>
                <td>場所</td>
                <td>{{ $map->place }}</td>
            </tr>
            <tr>
                <td>タイトル</td>
                <td>{{ $map->title }}</td>
            </tr>
            <tr>
                <td>詳細</td>
                <td>{!! nl2br(e($map->content)) !!}</td>

            </tr>
            <tr>
                <td>日付</td>
                <td>{{ $map->date }}</td>
            </tr>
        </tbody>
    </table>
    <!-- お気に入り機能 -->
    @if(!$defaultLiked)
    <form action="{{ route('likes.like',['map' => $map]) }}" method="POST">
        @csrf
        <button class='btn btn-default heart' type='submit'>
            <i class='far fa-heart faa-wrench animated-hover'></i>
        </button>
        <span class="likes-count">{{ $likesCount}}</span>
    </form>
    @else
    <form action="{{ route('likes.unlike',['map' => $map]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class='btn btn-default heart' type='submit'>
            <i class='fas fa-heart faa-wrench animated-hover'></i>
        </button>
        <span class="likes-count">{{ $likesCount }}</span>
    </form>
    @endif
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

    <!-- コメントを表示 -->
    <h2 class="mt-5">コメント一覧</h2>
    <div id="data">
        @forelse ($map->comments as $comment)
        <div class="media w-75 mx-auto border-bottom mt-1">
            <a href="{{route('users.show', ['user' => $comment->user->id]) }}">
                <img src="{{ $comment->user->avatar_image }}" width="50" class="rounded-circle">
                <p>{{ $comment->user->name }}</p>
            </a>
            <div class="media-body">
                <p class="mb-3 ">{{ $comment->body }}</p>
                {{ $comment->created_at }}
                @if($comment->user_id === Auth::id())
                <form action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" id="commentDelete"
                        onclick="return confirm('本当に削除して宜しいですか？');">
                        削除
                    </button>
                </form>
                @endif
            </div>
        </div><!-- /.media -->
        @empty
        <p id="noComment">コメントがありません。</p>
        @endforelse
    </div>
    <form method="POST" action="{{ route('comments.store', $map) }}" name="commentForm" id="commentForm">
        @csrf
        <span id="commentResult"></span>
        <div class="form-group">
            <label for="comment">コメントフォーム</label>
            <input type="text" class="form-control w-75 mx-auto" name="body" value="{{ old('body') }}">
        </div>
        <input type="submit" class="btn btn-outline-success w-75" value="コメント">
    </form>
</div>
@if(Auth::check())
@php
$auth = 'true';
@endphp
@else
@php
$auth = 'false';
@endphp
@endif
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

    // コメントを非同期で
    $('#commentForm').on('submit', function (e) {
        var userId = '<?php echo $auth; ?>';
        if (userId === 'false') {
            alert('コメントするにはログインが必要です。');
            return false;
        }
        e.preventDefault();
        $.ajax({
                url: "/map/<?php echo $map->id; ?>/comments",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json"
            })
            .done((data) => {
                var html = '';
                // バリデーションエラー時
                if (data.errors) {
                    html = '<div class="alert alert-danger alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><ul>';
                    for (var i = 0; i < data.errors.length; i++) {
                        html += '<li>' + data.errors[i] + '</li>';
                    }
                    html += '</ul></div>';
                }
                // バリデーション通過時
                if (data.success) {
                    $('#noComment').remove();
                    html = '<div class="alert alert-primary alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>' +
                        data.success + '</div>';
                    $('#commentForm')[0].reset();
                    // 最後のコメント後に要素を追加
                    $('#data').append('<div class="media w-75 mx-auto border-bottom mt-1">' +
                        '<a href="/users/' + data.comment.user_id + '">' +
                        '<img src="' + data.avatar + '" width="50" class="rounded-circle">' +
                        '<p>' + data.name + '</p></a>' +
                        '<div class="media-body">' + 
                        '<p class="mb-3">' + data.comment.body + '</p>' +
                        data.comment.created_at +
                        '<form action="/map/' + data.comment.id + '/comments"' + ' method="POST" class="d-inline">' +
                        '@csrf' +
                        '@method("DELETE")' +
                        '<button type="submit" class="btn btn-outline-danger" id="commentDelete" onclick="return confirm(`本当に削除して宜しいですか？`);">' +
                        '削除' +
                        '</button>' +
                        '</form>' +
                        '</div></div>');
                }
                $('#commentResult').html(html);
            });
    });

</script>
@endsection
