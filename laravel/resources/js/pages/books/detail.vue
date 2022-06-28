<template>
    <div>
        <p>detail</p>
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

        <!--
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
            axios.get('/api/book/detail-json/' + this.id)
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

