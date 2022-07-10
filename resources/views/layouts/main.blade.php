<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Import Excel to DB</title>
    @vite(['resources/js/app.js'])
</head>
<body style="padding: 50px 100px">
    <p>
        <a href="/">Upload XLSX</a> | <a href="/rows">Rows</a>
    </p>

    @yield('content')

    @if (\Session::has('success'))
    <div style="color: green">
        {{ \Session::get('success') }}
    </div>
    @endif

    @if ($errors->any())
        <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    
    <div id="echo-log" style="margin-top: 50px"></div>
</body>
</html>