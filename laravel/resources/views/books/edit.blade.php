<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    {{-- {{ dd(var_dump($book)) }} --}}
    <p>書籍情報更新フォーム</p>
    <form method="POST" action="/book/edit/{{ $book->id }}">
        @csrf
        <label>書籍名</label>
        <input type="text" name="name" value="{{ $book->name }}"></br>
        <label>著者名</label>
        <input type="text" name="author_id" value="{{ $book->author_id }}"></br>
        <label>出版社名</label>
        <input type="text" name="publisher_id" value="{{ $book->publisher_id }}"></br>
        <label>初版発行</label>
        <input type="text" name="first_published" value="{{ $book->first_published }}"></br>

        <input type="submit">
    </form>
    </br>
    <form method="POST" action="/book/delete/{{ $book->id }}">
        @csrf
        <label>削除</label><input type="submit">
    </form>

    <p>リンク一覧</p>
    <ul>
        <li><a href="/book/index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
