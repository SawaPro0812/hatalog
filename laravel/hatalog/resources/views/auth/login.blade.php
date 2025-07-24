<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン - 働ログ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>
<body class="login-container">
    <div class="login-header">
        <a href="/" class="link">トップへ戻る</a>
    </div>

    <h1 class="login-title">ログイン</h1>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <input type="text" name="login" placeholder="メールアドレス" required class="login-input">
        <input type="password" name="password" placeholder="パスワード" required class="login-input">

        <button type="submit" class="btn btn-start">ログイン</button>
    </form>

    <div class="login-footer">
        <a href="{{ route('register') }}" class="link">新規登録はこちら</a>
    </div>
</body>
</html>
