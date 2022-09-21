<template>
    <main class="main">
        <div class="content-wrapper">
            <div class="book-detail-container">
                <h3 class="title">書籍情報編集</h3>
                <div class="form-container">
                    <form method="POST" :action="'/api/book/edit/' + this.id" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrf" />
                        <!-- 書籍タイトル -->
                        <div class="title-area input-container">
                            <label class="label">書籍タイトル</label><br />
                            <input type="text" name="name" class="input_text" v-bind:value="book.name"/><br />
                        </div>
                        <!-- 著者 -->
                        <div class="author-select-area input-container">
                            <!-- 既存の著者から選択 -->
                            <label class="label">著者</label><br />
                            <!-- 各入力ボックス -->
                            <select class="select-container"
                                v-for="(author_info, index) in book.book_authors"
                                :key="author_info.id"
                                v-bind:name="'authors[' + index + ']'"
                                v-model="author_info.author.id">
                                <option v-for="author in authors"
                                    :key="author.id"
                                    v-bind:value="author.id">
                                    {{ author.name + '（' + author.name_furigana + '）'  }}
                                </option>
                            </select>
                            <select class="author-select select-container" :name="'authors['+ (6+index) + ']'"
                                    v-for="(text,index) in authors_select" :key="index">
                                <option disabled value="" selected>選択してください</option>
                                <option v-for="author in authors"
                                    v-bind:value="author.id"
                                    v-bind:key="author.id">
                                    {{ author.name }}
                                </option>
                            </select>
                            <br />
                            <div class="button-container">
                                <!-- 著者選択欄を追加するボタン -->
                                <button class="addButton" type="button" @click="addAuthorSelect()">追加する</button>
                                <br />
                                <!-- 著者選択欄の削除ボタン -->
                                <button type="button" @click="removeAuthorSelect(index)">削除</button>
                                <br />
                            </div>
                            <hr />
                            <p class="switch-text" type="button"
                                v-if="!authorsNewOpen"
                                @click="addAuthorsNew(index),
                                        authorsNewOpen=true">
                            または、新規登録者を追加する
                            </p>
                            <div class="author-new-area"
                                v-if="authorsNewOpen">
                                <label class="label">新規著者</label><br />
                                <!-- 新規著者名入力欄 -->
                                <div class="input-container" v-for="(author_new,index) in authors_new" :key="index">
                                    <input type="text" :name="'author_new_name['+ index + ']'"
                                        class="input_text"
                                        placeholder="新規著者名"
                                    />
                                    <br />
                                    <!-- 新規著者名ふりがな入力欄 -->
                                    <input type="text" :name="'author_new_name_furigana['+ index + ']'"
                                        class="input_text"
                                        placeholder="新規著者名（ふりがな）"
                                    />
                                    <br />
                                </div>
                                <div class="button-container">
                                    <!-- 入力ボックスを追加するボタン -->
                                    <button class="addButton" type="button" @click="addAuthorsNew()">追加する</button><br />
                                    <!-- 入力ボックスの削除ボタン -->
                                    <button type="button"
                                        @click="removeAuthorsNew(index),
                                        authorsNewOpen = checkAuthorsNew(authorsNewOpen)"
                                    >
                                    削除
                                    </button><br />
                                </div>
                            </div>
                        </div>
                        <!-- 出版社 -->
                        <div class="publisher-select-area input-container">
                            <label class="label">出版社</label>
                            <div class="publisher_input_area" v-if="!publisherNewOpen">
                                <select class="publisher-select select-container" name="publisher_id" >
                                    <option disabled value="">選択してください</option>
                                    <option v-for="publisher in publishers"
                                        v-bind:value="publisher.id"
                                        v-bind:key="publisher.id">
                                        {{ publisher.name }}
                                    </option>
                                </select>
                                <input type="hidden" name="publisher_name" class="input_text" />
                                <input type="hidden" name="publisher_name_furigana" class="input_text" />
                            </div>
                            <div class="publisher-new-area">
                                <div class="publisher_input_area" v-if="publisherNewOpen">
                                    <input type="text" name="publisher_name" class="input_text" placeholder="新規出版社名" />
                                    <input type="text" name="publisher_name_furigana" class="input_text" placeholder="新規出版社名（ふりがな）" />
                                </div>
                            </div>
                            <hr />
                            <p class="switch-text" v-if="publisherNewOpen" @click="publisherNewOpen=false">登録済みの出版社を選択する</p>
                            <p v-if="!publisherNewOpen" @click="publisherNewOpen=true">または新規出版社を登録する</p>
                        </div>

                        <!-- 初版発行時期 -->
                        <div class="first_publish-area input-container">
                            <label class="label">初出版</label><br />
                            <flat-pickr
                                class="first_publish-input input_text"
                                name="first_published"
                                v-model="book.first_published"
                                :config="flatOption"
                            />
                            <br />
                        </div>

                        <!-- 表紙 -->
                        <div class="image-area input-container">
                            <label class="label">表紙画像</label><br />
                            <!-- <img :src="'/storage/book_image/' + book.image_name" :alt= "book.name" class="book-image" /> -->
                            <input class="image-btn" type="file" name="book_image" /><br />
                            <br />
                        </div>

                        <input type="submit" class="submit-button" value="保存">
                    </form>
                </div>

                <!-- 削除ボタン -->
                <form method="POST" v-bind:action="'/api/book/delete/' + book.id">
                    <input type="hidden" name="_token" :value="csrf">
                    <input class="delete-button" type="submit" value="削除">
                </form>
            </div>

            <div class="chapter-container">
                <h3 class="title">チャプター</h3>
                <div class="form-container">
                    <table>
                        <!-- 既存チャプター -->
                        <tr v-for="(chapter, index) in chapters" :key="chapter.id">
                            <th>{{ index + 1 }}：</th>
                            <td>
                                <form class="chapter_form" method="POST" v-bind:action="'/api/chapter/edit/' + book.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="id" v-bind:value="chapter.id" />

                                    <div class="chapter_title_area">
                                        <label>チャプタータイトル</label>
                                        <div>
                                            <input type="text" class="input_text" name="chapter_title"
                                                v-bind:value="chapter.title">
                                        </div>
                                    </div>
                                    <div class="chapter_content_area">
                                        <label>チャプター内容</label>
                                        <div>
                                            <textarea class="chapter_input" name="chapter_summary"
                                                v-bind:value="chapter.summary" />
                                        </div>
                                    </div>

                                    <input class="chapters-submit-button" type="submit" />
                                </form>
                                <form class="chapter_form" method="POST" v-bind:action="'/api/chapter/delete/' + chapter.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="id" v-bind:value="chapter.id" />
                                    <input type="submit" class="chapters-delete-button" value="削除" />
                                </form>
                            </td>

                        </tr>
                        <!-- 新規チャプター -->
                        <tr>
                            <th>
                                ＊：
                            </th>
                            <td class="new_chapter">
                                <h5>新規チャプター</h5>
                                <form method="POST" v-bind:action="'/api/chapter/register'">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="book_id" v-bind:value="book.id" />
                                    <div class="chapter_title_area">
                                        <label>チャプタータイトル</label>
                                        <div>
                                            <input class="input_text" type="text" name="new_chapter_title"
                                                placeholder="新規チャプターのタイトル">
                                        </div>
                                    </div>
                                    <div class="chapter_content_area">
                                        <label>チャプター内容</label>
                                        <div>
                                            <textarea class="chapter_input" name="new_chapter_summary"
                                                placeholder="新規チャプターの内容"/>
                                        </div>
                                    </div>

                                    <input class="chapters-submit-button" type="submit" />
                                </form>
                            </td>
                        </tr>
                    </table>




                </div>
            </div>
        </div>
    </main>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import {Japanese} from 'flatpickr/dist/l10n/ja.js';

export default {
    props: {
        id: {type: Number},
    },
    components: {
        flatPickr
    },
    data:function(){
        return {
            msg:'wait...',
            book:[],
            authors_select: [],
            authors_new: [],
            authorsNewOpen: false,
            publisherNewOpen: false,
            date: null,
            flatOption:{
                locale: Japanese,
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods:{
        getBookDetail() {
            axios.get('/api/book/detail-json/' + this.id)
                .then((res) =>{
                    this.book = res.data;
                    this.msg = 'get data!';

                    let authors_select = [];
                    this.book.book_authors.forEach(element => {
                        authors_select.push(element);
                    });
                });
            // console.log(this.authors_select);
        },
        prepareBookAuthorsSelect(array1, array2) {
            array2.forEach(element => {
                array1.push(element);
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
        getChapterIndex() {
            axios.get('/api/chapter/index-json/' + this.id)
                .then((res) =>{
                    this.chapters = res.data;
                    this.msg = 'get chapters!';
                });
        },
        // 著者選択欄の削除
        removeAuthorSelect(index) {
            // this.authors_select.splice(index, 1); // 該当するデータを削除
            if(this.book.book_authors.length == 0) {
                this.authors_select.splice(index, 1); // 該当するデータを削除
            } else {
                this.book.book_authors.splice(index, 1); // 該当するデータを削除
            }
            // console.log(this.authors_select);

        },
        // 著者選択欄の追加
        addAuthorSelect() {
            // if(this.isTextMax) {
            //     return;
            // }
            // this.authors_select.push(''); // 配列に１つ空データを追加する
            this.authors_select.push(''); // 配列に１つ空データを追加する
            // console.log(this.authors_select);
            // Vue.nextTick(() => {
            //     const maxIndex = this.authors_select.length - 1;
            //     console.log(maxIndex)
            //     this.$refs['authors_select'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする
            // });
        },

        // 新規著者入力欄の削除
        removeAuthorsNew(index) {
            this.authors_new.splice(index, 1); // 該当するデータを削除

        },
        // 新規著者入力欄の追加
        addAuthorsNew() {
            if(this.isTextMax) {
                return;
            }
            this.authors_new.push(''); // 配列に１つ空データを追加する
            // Vue.nextTick(() => {
            //     const maxIndex = this.authors_select.length - 1;
            //     console.log(maxIndex)
            //     this.$refs['authors_select'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする
            // });
        },
        checkAuthorsNew(bool) {
            // boolはtrueであることが前提
            if(this.authors_new.length == 0) {
                bool = !bool;
                return bool;
            };
            return bool;
        },
    },
    mounted () {
        this.getBookDetail();
        this.getAuthorIndex();
        this.getPublisherIndex();
        this.getChapterIndex();
    },
}
</script>

<style>
    .publisher-container {
        display: flex;
        width: 100%;
    }

    .form-container {
        margin: 0 auto;
        width: 80%;
    }

    .label {
        font-size: 20px;
    }

    .input-container {
        margin-bottom: 15px;
    }

    .input_text {
        width: 420px;
        font-size: 16px;
    }

    .chapter_input {
        width: 420px;
        height: 200px;
        font-size: 16px;
    }

    .select-container {
        width: 420px;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .button-container {
        display: flex;
    }

    .addButton {
        margin-right: 10px;
    }

    .submit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        width:144px;
        height:40px;
        border-radius: 5%;
        border: none;
        background-color: #0c2e8f;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
        cursor:pointer;
        margin-bottom: 10px;
    }

    .delete-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        width:144px;
        height:40px;
        border-radius: 5%;
        background-color: #da1648;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
        cursor:pointer;
        margin-bottom: 10px;
    }

    .new_chapter {
        text-align: left;
    }

    .new_chapter > h5 {
        margin-bottom: 10px;
        border-bottom: 3px solid #0c2e8f;
        font-weight: bold;
        font-size: 20px;
    }

    .chapter_form {
        text-align: left;
    }

    .chapter_title_area {
        text-align: left;
        margin-bottom: 15px;
    }
    .chapter_content_area {
        text-align: left;
        margin-bottom: 10px;
    }

    .chapters-submit-button {
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
        font-size: 16px;
        cursor:pointer;
        margin: 0;
        margin-bottom: 5px;
    }

    .chapters-delete-button {
        display: flex;
        justify-content: center;
        align-items: center;
        width:144px;
        height:40px;
        border-radius: 5%;
        background-color: #da1648;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
        cursor:pointer;
        margin: 0;
        margin-bottom: 10px;
    }
</style>
