<template>
    <div>
        <!-- 新フォーム -->
        <div>
            <h3 class="title">出版社登録フォーム</h3>
            <div class="form-container" style="padding-top:0; padding-bottom:0;">
                <form method="POST" action="/api/book/register" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="csrf" />
                    <!-- 書籍タイトル -->
                    <div class="title-area">
                        <label class="label">書籍タイトル</label><br />
                        <input type="text" name="name" class="input_text" v-bind:value="book.name"/><br />
                    </div>
                    <!-- 著者 -->
                    <div class="author-select-area">
                        <!-- 既存の著者から選択 -->
                        <label class="label">著者</label><br />
                        <!-- 各入力ボックス -->
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
                        <!-- <select class="author-select" :name="'authors['+ index + ']'"
                            v-for="(text,index) in authors_select" :key="index">
                            <option disabled value="" selected>選択してください</option>
                            <option v-for="author in authors"
                                    v-bind:value="author.id"
                                    v-bind:key="author.id">
                                {{ author.name }}
                            </option>
                        </select> -->
                        <br />
                        <!-- 著者選択欄を追加するボタン -->
                        <button type="button" @click="addAuthorSelect()">追加する</button>
                        <br />
                        <!-- 著者選択欄の削除ボタン -->
                        <button type="button" @click="removeAuthorSelect(index)">削除</button>
                        <br />
                        <hr />
                        <p class="switch-text" type="button"
                            v-if="!authorsNewOpen"
                            @click="addAuthorsNew(index),
                                    authorsNewOpen=true">
                        または、新規登録者を追加する
                        </p>
                        <div class="author-new-area" v-if="authorsNewOpen">
                            <label class="label">新規著者</label><br />
                            <!-- 新規著者名入力欄 -->
                            <div v-for="(author_new,index) in authors_new" :key="index">
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
                            <!-- 入力ボックスを追加するボタン -->
                            <button type="button" @click="addAuthorsNew()">追加する</button>
                            <br />
                            <!-- 入力ボックスの削除ボタン -->
                            <button type="button"
                                @click="removeAuthorsNew(index),
                                authorsNewOpen = checkAuthorsNew(authorsNewOpen)"
                            >
                            削除
                            </button>
                            <br />
                        </div>
                    </div>
                    <!-- 出版社 -->
                    <div class="publisher-select-area">
                        <label class="label">出版社</label>
                        <div class="publisher_input_area" v-if="!publisherNewOpen">
                            <select class="publisher-select" name="publisher_id" >
                                <option disabled value="">選択してください</option>
                                <option v-for="publisher in publishers"
                                    v-bind:value="publisher.id"
                                    v-bind:key="publisher.id"
                                    >
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
                    <div class="first_publish-area">
                        <label class="label">初出版</label><br />
                        <flat-pickr
                            class="first_publish-input"
                            name="first_published"
                            v-model="book.first_published"
                            :config="flatOption"
                        />
                        <br />
                    </div>

                    <!-- 表紙 -->
                    <div class="image-area">
                        <label class="label">表紙画像</label><br />
                        <img :src="'/storage/book_image/' + book.image_name" :alt= "book.name" class="book-image" />
                        <input class="image-btn" type="file" name="book_image" /><br />
                        <br />
                    </div>

                    <input type="submit" class="submit-button">
                </form>
            </div>
        </div>

        <!-- 削除ボタン -->
        <form method="POST" v-bind:action="'/api/book/delete/' + book.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>削除：</label>
            <input type="submit" value="実行">
        </form>

        <div>---------------------</div>

        <h3>チャプター</h3>
        <!-- <table>
            <tr v-for="chapter in chapters" :key="chapter.id">
                <th>{{ chapter.id }}：</th>
                <td>
                    {{ chapter.title }}<br/>
                    {{ chapter.summary }}
                </td>
            </tr>
        </table> -->

        <!-- 既存チャプター -->
        <table>
            <tr v-for="(chapter, index) in chapters" :key="chapter.id">
                <th>{{ index + 1 }}：</th>
                <td>
                    <form method="POST" v-bind:action="'/api/chapter/edit/' + book.id">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="id" v-bind:value="chapter.id" />

                        <div>
                            <label>チャプタータイトル</label>
                            <div>
                                <input type="text" name="chapter_title" v-bind:value="chapter.title">
                            </div>
                        </div>
                        <div>
                            <label>チャプター内容</label>
                            <div>
                                <input type="text" name="chapter_summary" v-bind:value="chapter.summary">
                            </div>
                        </div>

                        <input type="submit" />
                    </form>
                    <form method="POST" v-bind:action="'/api/chapter/delete/' + chapter.id">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="id" v-bind:value="chapter.id" />
                        <input type="submit" value="削除" />
                    </form>
                </td>
                <!-- <form method="POST" v-bind:action="'/api/chapter/edit/' + book.id">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="book_id" v-bind:value="book.id" />
                    <div>
                        <label>チャプタータイトル</label>
                        <div>
                            <input type="text" name="chapter_title" v-bind:value="chapter.title">
                        </div>
                    </div>
                    <div>
                        <label>チャプター内容</label>
                        <div>
                            <input type="text" name="chapter_summary" v-bind:value="chapter.summary">
                        </div>
                    </div>

                    <input type="submit">
                </form> -->
            </tr>
        </table>


        <!-- 既存チャプター -->
        <!-- <form method="POST" v-bind:action="'/api/chapter/edit/' + book.id">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="book_id" v-bind:value="book.id" />
            <div>
                <label>チャプタータイトル</label>
                <div>
                    <input type="text" name="new_chapter_title" v-bind:value="chapter.title">
                </div>
            </div>
            <div>
                <label>チャプター内容</label>
                <div>
                    <input type="text" name="new_chapter_summary" v-bind:value="chapter.summary">
                </div>
            </div>

            <input type="submit">
        </form> -->

        <!-- 新規チャプター -->
        <form method="POST" v-bind:action="'/api/chapter/register'">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="book_id" v-bind:value="book.id" />
            <div>
                <label>チャプタータイトル</label>
                <div>
                    <input type="text" name="new_chapter_title">
                </div>
            </div>
            <div>
                <label>チャプター内容</label>
                <div>
                    <input type="text" name="new_chapter_summary">
                </div>
            </div>

            <input type="submit">
        </form>
    </div>
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
            authors_select: [''],
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
            this.authors_select.splice(index, 1); // 該当するデータを削除

        },
        // 著者選択欄の追加
        addAuthorSelect() {
            if(this.isTextMax) {
                return;
            }
            this.authors_select.push(''); // 配列に１つ空データを追加する
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

