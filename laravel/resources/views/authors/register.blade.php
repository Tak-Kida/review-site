<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>著者登録フォーム</p>
    <form method="POST" action="/author/register">
        @csrf
        <label>著者名</label>
        <input type="text" name="name" value="安宅 一夫"></br>
        <label>著者名（ふりがな）</label>
        <input type="text" name="name_furigana" value="アタカ カズオ"></br>
        <input type="submit">
    </form>

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
    </ul>

</body>

</html>
