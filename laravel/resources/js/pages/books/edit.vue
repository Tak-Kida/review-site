<template>
    <div>
        <p>書籍情報更新フォーム</p>
        <tr>
            <th scope="row">{{ book.id }}</th>
            <td>{{ book.name }}</td>
            <!-- <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td> -->
            <!-- <td><a v-bind:href="'/book/detail/' + book.id">詳細</a></td> -->
            <!-- <a href="/book/edit/{{ $book->id }}">編集・削除</a></br> -->
        </tr>

        <form method="POST" v-bind:action="'/book/edit/' + book.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>書籍名</label>
            <input type="text" name="name" v-bind:value="book.name ">
            <br />
            <label>著者名</label>
            <input type="text" name="author_id" v-bind:value="book.author_id ">
            <br />
            <label>出版社名</label>
            <input type="text" name="publisher_id" v-bind:value="book.publisher_id ">
            <br />
            <label>初版発行</label>
            <input type="text" name="first_published" v-bind:value="book.first_published ">
            <br />

            <input type="submit">
        </form>

        <form method="POST" v-bind:action="'/book/delete/' + book.id">
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
            axios.get('/book/detail-json/' + this.id)
                .then((res) =>{
                    this.book = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getBookDetail();
    },
}
</script>

