@extends('layout')

@section('content')
    <div class="container mt-3 text-center">
        <dl class="row">
            <dt class="col-md-3 py-3">
                @if ($user->avatar_image)
                    <img src="{{ $user->avatar_image }}" class="rounded-circle w-25">
                @else
                    <img src="{{ asset("noimage.png") }}" class="rounded-circle w-25">
             @endif
            </dt>
            <dd class="col-md-9 py-3"></dd>
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
        @if (Auth::user()->id === $user->id)
            <a href="{{ route('users.edit', ['user' => $user]) }}">
                <button class="btn btn-outline-warning w-50 mb-3">編集する</button>
            </a>
            @component('components.delete-btn')
            @slot('name', 'users')
            @slot('id', $user->id)
            @endcomponent
        @endif
        </form>
    </div>
@endsection