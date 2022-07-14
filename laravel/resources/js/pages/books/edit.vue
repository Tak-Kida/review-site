<template>
    <div>
        <p>書籍情報更新フォーム</p>
        <tr>
            <th scope="row">{{ book.id }}</th>
            <td>{{ book.name }}</td>
        </tr>

        <form method="POST" v-bind:action="'/api/book/edit/' + book.id">
            <input type="hidden" name="_token" :value="csrf">
            <div>
                <label>書籍名</label>
                <input type="text" name="name" v-bind:value="book.name ">
            </div>
            <div>
                <label>著者名</label>
                <select v-for="(author_info, index) in book.book_authors"
                    :key="author_info.id"
                    v-bind:name="'authors[' + index + ']'"
                    v-model="author_info.author.id">
                    <option v-for="author in authors"
                        :key="author.id"
                        v-bind:value="author.id"
                        >
                        {{ author.name + '（' + author.name_furigana + '）'  }}
                    </option>
                </select>
                <!-- <input type="text" name="author_new_name[0]" />
                <input type="text" name="author_new_name_furigana[0]" />
                <input type="text" name="author_new_name[1]" />
                <input type="text" name="author_new_name_furigana[1]" /> -->
            </div>
            <div>
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
            <div>
                <label>初版発行</label>
                <input type="text" name="first_published" v-bind:value="book.first_published " />
            </div>

            <input type="submit">
        </form>

        <form method="POST" v-bind:action="'/api/book/delete/' + book.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>削除：</label>
            <input type="submit" value="実行">
        </form>
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
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
        getAuthorIndex() {
            axios.get('/api/author/index-json')
                .then((res) =>{
                    this.authors = res.data;
                });
        },
        getPublisherIndex() {
            axios.get('/api/publisher/index-json')
                .then((res) =>{
                    this.publishers = res.data;
                });
        },
    },
    mounted () {
        this.getBookDetail();
        this.getAuthorIndex();
        this.getPublisherIndex();
    },
}
</script>

