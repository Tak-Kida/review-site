<template>
    <div>
        <h3>登録済み書籍タイトル一覧</h3>
        <p>{{ msg }}</p>
        <hr>
        <tr v-for="(book, index) in books" :key="index">
            <th scope="row">{{ book.id }}</th>
    +       <td>{{ book.name }}</td>
            <!-- <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td> -->
            <td><a v-bind:href="'/book/detail/' + book.id ">詳細</a></td>
            <td><a v-bind:href="'/book/edit/' + book.id ">編集・削除</a></td>
        </tr>
        <!-- <ul>
            <li v-for="(book,key) in books">
                {{book.id}}: {{book.name}}
            </li>
        </ul> -->

        <!-- @foreach ($books as $book)
            <p>{{ $book->name }}</p>
            <a href="/book/detail/{{ $book->id }}">詳細</a></br>
            <a href="/book/edit/{{ $book->id }}">編集・削除</a></br>
        @endforeach -->

        <p>リンク一覧</p>
        <ul>
            <li><router-link to="/book">index</router-link></li>
            <li><router-link to="/book/register">register</router-link></li>
        </ul>
    </div>
</template>

<script>

export default {
    data:function(){
        return {
            msg:'wait...',
            books:[],
        };
    },
    methods:{
        getBookIndex() {
            axios.get('/book/index-json')
                .then((res) =>{
                    this.books = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getBookIndex();
    },
}
</script>
