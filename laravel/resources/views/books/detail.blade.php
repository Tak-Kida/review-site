<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
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
    <ul>
        @foreach ($chapters as $chapter)
            <li>
                {{ $chapter->title }}<br>
                {{ $chapter->summary }}
                <a href="/chapter/edit/{{ $chapter->id }}">編集・削除</a>
            </li>
        @endforeach
    </ul>

    <p>--------------</p>

    <p>もくじと要約追加フォーム</p>
    <form method="POST" action="/chapter/register/{{ $book->id }}">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}"></br>
        <label>タイトル</label>
        <input type="text" name="title"></br>
        <label>要約内容</label>
        <input type="text" name="summary"></br>

        <input type="submit">
    </form>

    <p>----------------</p>
    <p>リンク一覧</p>
    <ul>
        <li><a href="/book/index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
