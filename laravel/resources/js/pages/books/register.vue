<template>
    <div>
        <p>書籍登録フォーム</p>
        <form method="POST" action="/book/register">
            <input type="hidden" name="_token" :value="csrf">
            <label>書籍名</label>
            <input type="text" name="name" value="イシューからはじめよ 知的生産の「シンプルな本質」">
            <br />
            <label>著者名</label>
            <input type="text" name="author_id" value="1">
            <br />
            <label>出版社名</label>
            <input type="text" name="publisher_id" value="1">
            <br />
            <label>初版発行</label>
            <input type="text" name="first_published" value="2010-11-01">
            <br />

            <input type="submit">
        </form>
    </div>
</template>

<script>
     export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
    }
</script>
