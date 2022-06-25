<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="app"></div>

    <script src="{{ asset('js/app.js') }}" defer="defer"></script>
</body>

</html>
