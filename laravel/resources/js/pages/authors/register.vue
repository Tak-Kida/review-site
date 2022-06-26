<template>
    <div>
        <p>著者登録フォーム</p>
        <form method="POST" action="/api/author/register">
            <input type="hidden" name="_token" :value="csrf">
            <label>著者名</label>
            <input type="text" name="name" value="安宅 一夫">
            <br />
            <label>著者名（ふりがな）</label>
            <input type="text" name="name_furigana" value="アタカ カズオ">
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
