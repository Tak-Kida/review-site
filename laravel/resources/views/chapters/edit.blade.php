<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>書籍情報更新フォーム</p>
    <form method="POST" action="/chapter/edit/{{ $chapter->id }}">
        @csrf
        <label>タイトル</label>
        <input type="text" name="title" value="{{ $chapter->title }}"></br>
        <label>要約内容</label>
        <input type="text" name="summary" value="{{ $chapter->summary }}"></br>
        <input type="submit">
    </form>
    </br>
    <form method="POST" action="/chapter/delete/{{ $chapter->id }}">
        @csrf
        <label>削除</label><input type="submit">
    </form>

    <p>リンク一覧</p>
    <ul>
        <li><a href="/chapter/index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
