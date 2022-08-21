<template>
    <main class="main">
        <div class="content-wrapper">
            <!-- 検索部分 -->
            <div class="top-container">
                <h3 class ="title">登録済み出版社名一覧</h3>
                <div class="search-container">
                    <p class="loading-message">{{ msg }}</p>
                    <BookRegisterModal class="link-box-end" />
                </div>
            </div>
            <hr />
            <!-- 書籍一覧部分 -->
            <div class="books-container">
                <ul class="book-box-container">
                    <li class="book-area" v-for="(book, index) in books" :key="index">
                        <div class="book-box">
                            <div class="book-image-area">
                                <!-- 書籍のサムネイル -->
                                <!-- 書籍の画像を表示する -->
                                <img :src="'/storage/book_image/' + book.image_name" :alt= "book.name" class="book-image" />
                            </div>
                            <div class="book-detail-area">
                                <h5 class="book-name">
                                    {{ book.name }}
                                </h5>
                                <!-- 書籍説明文 -->
                                <table class="book-detail">
                                    <!-- <tr>
                                        <th class="book-detail-header">id</th>
                                        <td class="book-detail-body">{{ book.publisher.id }}</td>
                                    </tr> -->
                                    <tr>
                                        <th class="book-detail-header">出版社</th>
                                        <td class="book-detail-body">
                                            {{ book.publisher.name }}<br />
                                            ({{ book.publisher.name_furigana }})
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="book-detail-header">著者</th>
                                        <td class="book-detail-body">
                                            <ul>
                                                <li class="author" v-for="(book_author, index) in book.book_authors" :key="index">
                                                    {{ book_author.author.name }}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="book-detail-header">初版</th>
                                        <td class="book-detail-body">
                                            {{ book.first_published }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- <tr v-for="(book, index) in books" :key="index">
                    <th scope="row">{{ book.id }}</th>
                    <td>{{ book.name }}</td>
                    <td><router-link to="'/book/detail/' + book.id">詳細</router-link></td>
                    <td><a v-bind:href="'/book/detail/' + book.id ">詳細</a></td>
                    <td><a v-bind:href="'/book/edit/' + book.id ">編集・削除</a></td>
                </tr> -->
            </div>
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
        </div>
    </main>
</template>

<script>
import BookRegisterModal from "../../components/book/BookRegisterModal";

export default {
    components: {
        BookRegisterModal,
    },
    data:function(){
        return {
            msg:'データ取得中...',
            books:[],
        };
    },
    methods:{
        getBookIndex() {
            axios.get('/api/book/index-json')
                .then((res) =>{
                    this.books = res.data;
                    this.msg = '登録されている書籍は以下のとおりです';
                });
        }
    },
    mounted () {
        this.getBookIndex();
    },
}
</script>

<style>
    .search-container {
        display: flex;
        justify-content: space-between;
    }

    .bottom-container {
        display: flex;
        justify-content: space-between;
    }

    .loading-message {
        margin-bottom: 10px;
    }

    .link-box, .link-box-end {
        display: flex;
        justify-content: center;
        align-items: center;
        width:144px;
        height:40px;
        border-radius: 5%;
        border: none;
        background-color: #0c2e8f;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
    }

    .link-box {
        margin: 0 auto;
    }

    .book-box-container {
        display:flex;
        flex-wrap:wrap;
    }

    .book-area {
        display: flex;
        width: 50%;
        /* height: 400px; */
    }

    .book-image-area {
        display: flex;
        margin-bottom: 10px;
    }

    .book-box {
        margin: auto;
        margin-bottom: 10px;
        width: 80%;
        padding: 20px;
        padding-bottom: 60px;
        background-color: #fafafa;
        border: 3px solid;
        border-radius: 8px;
        border-color: #0c2e8f;
    }

    .book-image {
        margin: auto;
        width: 200px;
        height: 256px;
    }


    .book-detail-area {
        display: flex;
        flex-wrap: wrap;
    }

    .book-detail {
        display: table;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
        margin: auto;
        width: 85%;
    }

    .book-name {
        font-size: 18px;
        font-weight: bold;
        margin: auto;
        margin-bottom: 10px;
    }

    .book-detail-header {
        font-size: 18px;
        text-align: center;
        vertical-align: middle;
    }

    .book-detail-body {
        font-size: 16px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        padding: 10px;
        background-color: red;
        color: #fafafa;
    }

    td{
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }

</style>
