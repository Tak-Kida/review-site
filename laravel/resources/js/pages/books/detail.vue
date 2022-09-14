<template>
    <main class="main">
        <div class="content-wrapper">
            <h3 class ="title">書籍情報詳細</h3>
            <div class="book-information-area">
                <div class="book-image-area" href="book/detail/{{ book.id }}">
                    <!-- 書籍のサムネイル -->
                    <!-- 書籍の画像を表示する -->
                    <img :src="'/storage/book_image/' + book.image_name" :alt= "book.name" class="book-image" />
                </div>
                <table class="book-information">
                    <tr>
                        <th>ID</th>
                        <td scope="row">{{ book.id }}</td>
                    </tr>
                    <tr>
                        <th>書籍名</th>
                        <td>{{ book.name }}</td>
                    </tr>
                    <tr>
                        <th class="authors_name_row">著者名</th>
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
                    <!-- <tr><a v-bind:href="'/book/edit/' + book.id ">編集・削除</a></tr> -->
                </table>
                <BookEditModal class="link-box-end"
                    :book_name="book.name"
                    :book_authors="book.authors"
                    :book_publisher="book.publisher"
                    :book_first_published="book.first_published"
                    :book_image_name="book.image_name"
                />
                <div>{{ book }}</div>
            </div>
        </div>
        <hr />

        <!-- チャプター -->
        <h3 class="title">チャプター</h3>
        <table>
            <thead>
                <tr>
                    <th>章タイトル</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="chapter in chapters" :key="chapter.id">
                    <td>{{ chapter.title }}：</td>
                    <td>
                        {{ chapter.summary }}
                    </td>
                </tr>
            </tbody>
        </table>
        <a v-bind:href="'/book/edit/' + book.id ">編集・削除</a>
    </main>
</template>

<script>
import BookEditModal from "../../components/book/BookEditModal";

export default {
    components: {
        BookEditModal,
    },
    props: {
        id: {type: Number},
    },
    data:function(){
        return {
            msg:'wait...',
            book:[],
            chapters:[],

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
            axios.get('/api/chapter/index-json/' + this.id)
                .then((res) =>{
                    this.chapters = res.data;
                    this.msg = 'get chapters!';
                });
        },
        changeUnscrollable() {
            // 画面最上段にスクロールする
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            let element = document.querySelector('body');
            element.style.overflow = 'hidden';
        }
    },
    mounted () {
        this.getBookDetail();
        this.getChapterIndex();
    },
}
</script>

<style scoped>
    .book-image {
        margin: auto;
        width: 300px;
        height: 384px;
    }

    .book-information{
        margin: 0 auto;
        width: 90%;
    }

    .authors_name_row{
        vertical-align: middle;
    }

</style>
