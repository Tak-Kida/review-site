<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    {{-- {{ dd(var_dump($book)) }} --}}
    <p>書籍情報更新フォーム</p>
    <form method="POST" action="/author/edit/{{ $author->id }}">
        @csrf
        <label>著者名</label>
        <input type="text" name="name" value="安宅 一夫"></br>
        <label>著者名（ふりがな）</label>
        <input type="text" name="name_furigana" value="アタカ カズオ"></br>
        <input type="submit">
    </form>
    </br>
    <form method="POST" action="/author/delete/{{ $author->id }}">
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
