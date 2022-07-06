<template>
    <div>
        <p>書籍登録フォーム</p>
        <form method="POST" action="/api/book/register">
            <input type="hidden" name="_token" :value="csrf">
            <!-- 書籍名欄 -->
            <div class="book_block">
                <label>書籍名</label>
                <input type="text" name="name" value="イシューからはじめよ 知的生産の「シンプルな本質」">
            </div>
            <!-- 著者情報欄 -->
            <div class="author_block">
                <label>著者名</label>
                <input type="text" name="authors[0]" value="1" />
                <input type="text" name="authors[1]" value="2" />
                <input type="text" name="authors[2]" value="3" />
                <input type="text" name="author_new_name[0]" value="養老孟司" />
                <input type="text" name="author_new_name_furigana[0]" value="ようろうたけし" />
                <input type="text" name="author_new_name[1]" value="森永卓郎" />
                <input type="text" name="author_new_name_furigana[1]" value="もりながたくろう" />
            </div>
            <!-- 出版社情報欄 -->
            <div class="publisher_block">
                <label>出版社名</label>
                <select name="publisher_id">
                    <option disabled value="">選択してください</option>
                    <option v-for="publisher in publishers"
                        v-bind:value="publisher.id"
                        v-bind:key="publisher.id">
                        {{ publisher.name }}
                    </option>
                </select>
                <input type="text" name="publisher_name" value="" />
                <input type="text" name="publisher_name_furigana" value="" />
            </div>
            <!-- 初版発行欄 -->
            <div>
                <label>初版発行</label>
                <input type="text" name="first_published" value="2010-11-01">
            </div>

            <input type="submit">
        </form>
    {{ msg }}
    </div>
</template>

<script>
export default {
    data:function() {
        return {
            msg:'wait...',
            publishers: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    },
    methods:{
        getPublisherIndex() {
            axios.get('/api/publisher/index-json')
                .then((res) =>{
                    this.publishers = res.data;

                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getPublisherIndex();
    },
}
</script>
