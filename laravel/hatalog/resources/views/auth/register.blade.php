<!DOCTYPE html>
<html>
<head>
    <title>ユーザ登録</title>
</head>
<body>
    <h1>ユーザ登録</h1>
    <form method="POST" action="{{ route('registrer.store') }}">
        @csrf
        <input type="text" name="user_id" placeholder="ユーザID" required>
        <input type="text" name="email" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
