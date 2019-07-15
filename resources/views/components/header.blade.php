<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="/" class="navbar-brand">ホーム</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        @guest
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">ユーザー登録</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">ログイン</a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}" class="nav-link">{{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('map') }}" class="nav-link">マップ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('ログアウト') }}
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            </li>
        @endguest
        </ul>
    </div>
</nav>
