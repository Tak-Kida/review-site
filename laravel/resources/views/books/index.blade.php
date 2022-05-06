<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>登録済み書籍タイトル一覧</p>
    @foreach ($books as $book)
        <p>{{ $book->name }}</p>
        <a href="/book/edit/{{ $book->id }}">編集・削除</a></br>
    @endforeach

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
