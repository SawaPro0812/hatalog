<!DOCTYPE html>
<html>
<head>
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" name="login" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit">ログイン</button>
    </form>
    <a href="{{ route('register') }}">新規登録</a>
</body>
</html>
