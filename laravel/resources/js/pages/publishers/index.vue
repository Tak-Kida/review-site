<template>
    <div>
        <h3>登録済み出版社名一覧</h3>
        <p>{{ msg }}</p>
        <hr>
        <tr v-for="(publisher, index) in publishers" :key="index">
            <th scope="row">{{ publisher.id }}</th>
    +       <td>{{ publisher.name }}</td>
            <!-- <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td> -->
            <td><a v-bind:href="'/publisher/edit/' + publisher.id ">編集・削除</a></td>
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
            <li><router-link to="/publisher">index</router-link></li>
            <li><router-link to="/publisher/register">register</router-link></li>
        </ul>
    </div>
</template>

<script>

export default {
    data:function(){
        return {
            msg:'wait...',
            publishers:[],
        };
    },
    methods:{
        getPublisherIndex() {
            axios.get('/publisher/index-json')
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
