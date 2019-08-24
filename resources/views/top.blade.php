@extends('layout')

@section('content')
<!-- Page Content -->
<div class="container-fruid">

    <!-- Jumbotron Header -->
    <div class="jumbotron mb-4 border-primary top-image">
        <div class="bg-mask">
            <h1 class="display-1 main-ttl">Gmap App</h1>
            <a href="{{ route('map.index') }}" class="btn btn-dark btn-lg">マップを見る</a>
            <a href="{{ route('login') }}" class="btn btn-dark btn-lg">ログイン</a>
        </div>
    </div>
</div>
<!-- ./container-fluid -->

<!-- Page Features -->
<div class="container">
    <div class="row text-center">

        <div class="col-10 offset-1 mb-4">
            <div class="card h-100 border-primary">
                <img class="card-img-top card-header" src="{{ asset('map.png') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title text-secondary">地図を元に、出かけられる仲間を探す仲間募集アプリです。</h4>
                </div>
                <div class="card-footer">
                    <a href="{{ route('map.index') }}" class="btn btn-outline-dark">地図を見る</a>
                </div>
            </div>
        </div>

        <div class="col-10 offset-1 mb-4">
            <div class="card h-100 border-primary">
                <img class="card-img-top card-header" src="{{ asset('comment.png') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title text-secondary">気になる予定があったらコメントして見ましょう。<br>都合が合えば一緒に遊んで楽しい時間を共有可能</h4>
                </div>
                <div class="card-footer">
                    <a href="{{ route('map.show', ['map' => 1]) }}" class="btn btn-outline-dark">募集情報をみる</a>
                </div>
            </div>
        </div>

        <div class="col-10 offset-1 mb-4">
            <div class="card h-100 border-primary">
                <img class="card-img-top card-header" src="{{ asset('map-post.png') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">募集をかけることも可能です。</h4>
                    <p class="card-text">※行きたいお店や場所の上でダブルクリックして下さい。投稿フォームが表示され、募集を登録するとその地点にマーカーが置かれます。</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">ログイン</a>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection
