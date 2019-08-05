@extends('layout')

@section('content')
    <div class="container mt-3 text-center">
        <h2>ユーザー詳細</h2>
        @if ($user->avatar_image)
            <dd class="col-md-9 w-25"><img src="{{ $user->avatar_image }}" class="rounded-circle w-25"></dd>
        @else
            <dd class="col-md-9 w-25"><img src="{{ asset("noimage.png") }}" class="rounded-circle w-25"></dd>
        @endif
        <table class="table table-striped mb-4">
            <tbody>
                <tr>
                    <td>名前</td>
                    <td><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></td>
                </tr>
                @if(Auth::id() === $user->id)
                    <tr>
                        <td>メールアドレス</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endif
                <tr>
                    <td>性別</td>
                    <td>{{ $user->sex }}</td>
                </tr>
                <tr>
                    <td>年齢</td>
                    <td>{{ $user->age }}</td>
                </tr>
                <tr>
                    <td>自己紹介</td>
                    <td>{{ $user->profile }}</td>
                </tr>
            </tbody>
        </table>
        @if (Auth::id() === $user->id)
            <a href="{{ route('users.edit', ['user' => $user]) }}">
                <button class="btn btn-outline-primary w-50 mb-3">編集する</button>
            </a>
            @component('components.delete-btn')
            @slot('name', 'users')
            @slot('id', $user->id)
            @endcomponent
        @endif

        <ul class="nav nav-tabs nav-fill mt-5">
            <li class="nav-item nav-item-show"><a href="#" id="postsTab" class="nav-link active">投稿一覧</a></li>
            <li class="nav-item nav-item-show"><a href="#" id="favosTab" class="nav-link">お気に入り一覧</a></li>
            <li class="nav-item nav-item-show"><a href="#" id="commentsTab" class="nav-link">コメント一覧</a></li>
        </ul>

        <div id="myPosts" class="nav-cnt mt-5">
            <div class="row">
                @forelse($user->maps as $map)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                タイトル：{{ $map->title }}
                            </div>
                            <div class="card-body">
                                <p>場所：{{ $map->place }}</p>
                                <p>日時：{{ $map->date }}</p>
                                <a href="{{ route('map.show', ['map' => $map]) }}"><button class="btn btn-outline-primary">詳細</button></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>投稿はありません。</p>
                @endforelse
            </div>
        </div>

        <div id="myFavos" class="nav-cnt mt-5">
            <div class="row">
                @forelse($user->likes as $like)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <p>投稿タイトル：{{ $like->map->title }}</p>
                            </div>
                            <div class="card-body">
                                <p>場所：{{ $like->map->place }}</p>
                                <p>日付：{{ $like->map->date }}</p>
                                <a href="{{ route('map.show', ['map' => $like->map->id]) }}"><button class="btn btn-outline-primary">詳細</button></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>お気に入りはありません。</p>
                @endforelse
            </div>
        </div>

        <div id="myComments" class="nav-cnt mt-5">
            <div class="row">
                @forelse($user->comments as $comment)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <p>投稿タイトル：{{ $comment->map->date }}</p>
                                <p>場所：{{ $comment->map->place }}</p>
                                <p>日時：{{ $comment->map->date }}</p>
                            </div>
                            <div class="card-body">
                                <img src="{{ $comment->user->avatar_image }}" width="50" class="rounded-circle mr-2">
                                コメント内容：{{ $comment->body }}
                                <a href="{{ route('map.show', ['map' => $comment->map]) }}"><button class="btn btn-outline-primary">詳細</button></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>コメントはありません。</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- ./container -->
@endsection

@section('scripts')
<script>
$(".nav-item-show a").on('click', function(e) {
    e.preventDefault();
    $('.nav-cnt').css('display', 'none');
    $('.nav-item a').removeClass('active');
});
$('#postsTab').on('click', function(e) {
    $('#postsTab').addClass('active');
    $('#myPosts').css('display', 'block');
});
$('#favosTab').on('click', function(e) {
    $('#favosTab').addClass('active');
    $('#myFavos').css('display', 'block');
});
$('#commentsTab').on('click', function(e) {
    $('#commentsTab').addClass('active');
    $('#myComments').css('display', 'block');
});
</script>    
@endsection