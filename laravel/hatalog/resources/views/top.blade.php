<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>haralog</title>

        <script src="{{asset('/js/library/jquery-3.7.1.min.js')}}"></script>
        <script src="{{asset('/js/comm.js')}}"></script>
        <script src="{{asset('/js/top.js')}}"></script>
    </head>
    <body>
    働ログ
    <button id="work-start">勤務開始</button>
    </body>
</html>