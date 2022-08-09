<template>
    <main class="main">
        <div class="content-wrapper">
            <h3 class="title">出版社登録フォーム</h3>
            <form method="POST" action="/api/publisher/register">
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
    </main>
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
