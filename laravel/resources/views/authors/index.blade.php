<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>著者一覧</p>
    @foreach ($authors as $author)
        <a href="/author/edit/{{ $author->id }}">{{ $author->name }}（ {{ $author->name_furigana }} ）</a></br>
    @endforeach

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
