<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザ登録 - 働ログ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
</head>
<body class="register-container">
    <div class="register-header">
        <a href="/" class="link">トップへ戻る</a>
    </div>

    <h1 class="register-title">ユーザ登録</h1>

    <form method="POST" action="{{ route('register') }}" class="register-form">
        @csrf

        <input type="text" name="name" placeholder="ユーザ名" required class="register-input">
        <input type="text" name="user_id" placeholder="ユーザID" required class="register-input">
        <input type="email" name="email" placeholder="メールアドレス" required class="register-input">
        <input type="password" name="password" placeholder="パスワード" required class="register-input">
        <input type="password" name="password_confirmation" placeholder="パスワード（確認）" required class="register-input">

        <button type="submit" class="btn btn-start">登録</button>
    </form>

    <div class="register-footer">
        <a href="{{ route('login') }}" class="link">ログインはこちら</a>
    </div>
</body>
</html>
