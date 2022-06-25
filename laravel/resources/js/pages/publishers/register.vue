<template>
    <div>
        <p>出版社登録フォーム</p>
        <form method="POST" action="/publisher/register">
            <input type="hidden" name="_token" :value="csrf">
            <label>出版社名</label>
            <input type="text" name="name" value="英治出版">
            <br />
            <label>出版社名（ふりがな）</label>
            <input type="text" name="name_furigana" value="えいじしゅっぱん">
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
