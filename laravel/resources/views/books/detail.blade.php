<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    {{-- {{ dd(var_dump($book)) }} --}}
    <p>書籍情報</p>
    <label>書籍名</label>
    <p>{{ $book->name }}</p></br>
    <label>著者名</label>
    <p>{{ $book->author_id }}</p></br>
    <label>出版社名</label>
    <p>{{ $book->publisher_id }}</p></br>
    <label>初版発行</label>
    <p>{{ $book->first_published }}</p></br>

    <a href="/book/edit/{{ $book->id }}">書籍情報編集</a>

    <p>--------------</p>
    <p>もくじ</p>
    <p>※ここにチャプターが入ります</p>


    <p>リンク一覧</p>
    <ul>
        <li><a href="/book/index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
