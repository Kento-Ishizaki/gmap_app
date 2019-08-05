@extends('layout')

@section('content')
    <div class="container mt-3 text-center">
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
                <button class="btn btn-outline-warning w-50 mb-3">編集する</button>
            </a>
            @component('components.delete-btn')
            @slot('name', 'users')
            @slot('id', $user->id)
            @endcomponent
        @endif
    </div>
@endsection