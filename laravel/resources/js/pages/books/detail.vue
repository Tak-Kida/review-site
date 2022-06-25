<template>
    <div>
        <p>detail</p>
        <tr>
            <th scope="row">{{ book.id }}</th>
            <td>{{ book.name }}</td>
            <!-- <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td> -->
            <!-- <td><a v-bind:href="'/book/detail/' + book.id">詳細</a></td> -->
            <!-- <a href="/book/edit/{{ $book->id }}">編集・削除</a></br> -->
        </tr>
        <!-- <p>{{ book }}</p> -->
        <!-- <p>書籍情報</p>
        <label>書籍名</label>
        <p>{{ $book->name }}</p></br>
        <label>著者名</label>
        <p>{{ $author->name }}（{{ $author->name_furigana }}）</p></br>
        <label>出版社名</label>
        <p>{{ $publisher->name }}（{{ $publisher->name_furigana }}）</p></br>
        <label>初版発行</label>
        <p>{{ $book->first_published }}</p></br>

        <a href="/book/edit/{{ $book->id }}">書籍情報編集</a>

        <p>--------------</p>
        <p>もくじ</p>
        <ul>
            @foreach ($chapters as $chapter)
                <li>
                    {{ $chapter->title }}<br>
                    {{ $chapter->summary }}
                    <a href="/chapter/edit/{{ $chapter->id }}">編集・削除</a>
                </li>
            @endforeach
        </ul>

        <p>--------------</p>

        <p>もくじと要約追加フォーム</p>
        <form method="POST" action="/chapter/register/{{ $book->id }}">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}"></br>
            <label>タイトル</label>
            <input type="text" name="title"></br>
            <label>要約内容</label>
            <input type="text" name="summary"></br>

            <input type="submit">
        </form> -->
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

