@extends('layout')

@section('content')
    <!-- Page Content -->
    <div class="container-fruid">

        <!-- Jumbotron Header -->
        <div class="jumbotron mb-4 border-primary top-image">
            <div class="bg-mask">
                <h1 class="display-1 main-ttl">Gmap App</h1>
                <a href="{{ route('map.index') }}" class="btn btn-dark btn-lg">マップを見る</a>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">ログイン</a>
            </div>
        </div>
    </div>
    <!-- ./container-fluid -->

    <!-- Page Features -->
    <div class="container">
        <div class="row text-center">

        <div class="col-lg-4 mb-4">
            <div class="card h-100 border-primary">
            <img class="card-img-top card-header" src="{{ asset('test-user.png') }}" alt="">
            <div class="card-body">
                <h4 class="card-title">まずはみんなの予定を確認</h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-outline-warning">Find Out More!</a>
            </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100 border-primary">
            <img class="card-img-top card-header" src="{{ asset('test-user.png') }}" alt="">
            <div class="card-body">
                <h4 class="card-title">気になる予定があったらコメントして見ましょう</h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni sapiente, tempore debitis beatae culpa natus architecto.</p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-outline-warning">Find Out More!</a>
            </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100 border-primary">
            <img class="card-img-top card-header" src="{{ asset('test-user.png') }}" alt="">
            <div class="card-body">
                <h4 class="card-title">テストユーザーでもログイン可能です</h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
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