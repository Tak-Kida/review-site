<template>
    <div>
        <h1>書籍情報詳細</h1>
        <table>
            <tr>
                <th>ID</th>
                <td scope="row">{{ book.id }}</td>
            </tr>
            <tr>
                <th>書籍名</th>
                <td>{{ book.name }}</td>
            </tr>
            <tr>
                <th>著者名</th>
                <td>
                    <div v-for="author_info in book.book_authors" :key="author_info.id">
                            {{ author_info.author.name }} （{{ author_info.author.name_furigana }}）
                    </div>
                </td>
            </tr>
            <tr>
                <th>出版社名</th>
                <td v-if="book.publisher && book.publisher['name']">
                    {{ book.publisher['name'] }}
                </td>
            </tr>
            <tr>
                <th>初版発行</th>
                <td>{{ book.first_published }}</td>
            </tr>
        </table>

        <a v-bind:href="'/book/edit/' + book.id ">編集・削除</a>
        <div>---------------------</div>

        <h3>チャプター</h3>
        <table>
            <tr v-for="chapter in chapters" :key="chapter.id">
                <th>{{ chapter.id }}：</th>
                <td>
                    {{ chapter.title }}<br/>
                    {{ chapter.summary }}
                </td>
            </tr>
        </table>
        <a v-bind:href="'/book/edit/' + book.id ">編集・削除</a>
    </div>
</template>

<script>
export default {
    props: {
        id: {type: Number},
    },
    data:function(){
        return {
            msg:'wait...',
            book:[],

        };
    },
    methods:{
        getBookDetail() {
            axios.get('/api/book/detail-json/' + this.id)
                .then((res) =>{
                    this.book = res.data;
                    this.msg = 'get data!';
                });
        },
        getChapterIndex() {
            axios.get('/api/chapter/index-json')
                .then((res) =>{
                    this.chapters = res.data;
                    this.msg = 'get chapters!';
                });
        }
    },
    mounted () {
        this.getBookDetail();
        this.getChapterIndex();
    },
}
</script>

