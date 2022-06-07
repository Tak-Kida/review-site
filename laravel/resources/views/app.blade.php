<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    {{-- <h3>リンク一覧</h3>
    <ul>
        <li><a href="book/index">books</a></li>
        <li><a href="author/index">authors</a></li>
    </ul> --}}
    <div id="app"></div>

    <script src="{{ asset('js/app.js') }}" defer="defer"></script>
</body>

</html>
