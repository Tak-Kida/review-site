<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head></head>

<body>
    <p>書籍登録フォーム</p>
    <form method="POST" action="/book/register">
        @csrf
        <label>書籍名</label>
        <input type="text" name="name" value="イシューからはじめよ 知的生産の「シンプルな本質」"></br>
        <label>著者名</label>
        <input type="text" name="author_id" value="1"></br>
        <label>出版社名</label>
        <input type="text" name="publisher_id" value="1"></br>
        <label>初版発行</label>
        <input type="text" name="first_published" value="2010-11-01"></br>

        <input type="submit">
    </form>

    <p>リンク一覧</p>
    <ul>
        <li><a href="index">index</a></li>
        <li><a href="register">register</a></li>
        <li><a href="edit">edit※ToDo</a></li>
    </ul>

</body>

</html>
