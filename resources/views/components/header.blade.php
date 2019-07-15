<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="/" class="navbar-brand">ホーム</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">ユーザー登録</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">ログイン</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('map') }}" class="nav-link">マップ</a>
            </li>
        </ul>
    </div>
</nav>
