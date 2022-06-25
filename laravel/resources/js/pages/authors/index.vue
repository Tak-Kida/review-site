<template>
    <div>
        <h3>登録済み著者名一覧</h3>
        <p>{{ msg }}</p>
        <hr>
        <tr v-for="(author, index) in authors" :key="index">
            <th scope="row">{{ author.id }}</th>
    +       <td>{{ author.name }}</td>
            <!-- <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td> -->
            <td><a v-bind:href="'/author/edit/' + author.id ">編集・削除</a></td>
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
            <li><router-link to="/author">index</router-link></li>
            <li><router-link to="/author/register">register</router-link></li>
        </ul>
    </div>
</template>

<script>

export default {
    data:function(){
        return {
            msg:'wait...',
            authors:[],
        };
    },
    methods:{
        getAuthorIndex() {
            axios.get('/author/index-json')
                .then((res) =>{
                    this.authors = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getAuthorIndex();
    },
}
</script>
