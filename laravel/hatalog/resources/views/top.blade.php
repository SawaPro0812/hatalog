<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>hatalog</title>

    <link rel="stylesheet" href="{{ asset('/css/top.css') }}">
    <script src="{{ asset('/js/library/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/comm.js') }}"></script>
    <script src="{{ asset('/js/top.js') }}"></script>
</head>
<body class="container">
    <div class="top-header">
        {{-- ログインしていない場合 --}}
        @guest
            <a href="/login" class="login-link link">ログイン</a>
        @endguest
        {{-- ログインしている場合 --}}
        @auth
            <a href="/history" class="link">勤務履歴</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="login-link link">ログアウト</button>
            </form>
        @endauth
        <a href="/help" class="link">使用方法</a>
    </div>
    <h1 class="title">働ログ</h1>
    <div class="total-time-box">
        <div id="total-time">合計勤務時間： <span id="total-time-value">00:00:00</span></div>
    </div>
    <div class="button-group">
        <button id="work-start" class="btn btn-start">勤務開始</button>
        <button id="work-end" class="btn btn-end">勤務終了</button>
    </div>
    <div class="table-area">
        <table class="log-table">
            <thead>
                <tr>
                    <th width="30%">開始</th>
                    <th width="10%">～</th>
                    <th width="30%">終了</th>
                    <th width="30%">時間</th>
                </tr>
            </thead>
            <tbody id="log-body">
                <!-- ログ行をここに追加 -->
            </tbody>
        </table>
    </div>

    <!-- トースト通知 -->
    <div id="toast" class="toast-message"></div>
</body>
</html>
