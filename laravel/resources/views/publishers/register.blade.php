<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>著者登録フォーム</p>
    <form method="POST" action="/publisher/register">
        @csrf
        <label>出版社名</label>
        <input type="text" name="name" value="英治出版"></br>
        <label>出版社名（ふりがな）</label>
        <input type="text" name="name_furigana" value="えいじしゅっぱん"></br>
        <input type="submit">
    </form>

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
