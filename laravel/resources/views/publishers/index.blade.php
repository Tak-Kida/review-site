<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>出版社一覧</p>
    @foreach ($publishers as $publisher)
        <a href="/publisher/edit/{{ $publisher->id }}">
            {{ $publisher->name }}（ {{ $publisher->name_furigana }}）
        </a>
        </br>
    @endforeach

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
