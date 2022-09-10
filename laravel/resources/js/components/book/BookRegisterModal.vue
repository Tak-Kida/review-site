<template>
    <div>
        <button class="register-button" @click="modalOpen = true">
            新規登録
        </button>

        <teleport to="body">
            <div v-if="modalOpen" class="modal">
                <!-- タイトルが画面から切れないようmarginを入れる -->
                <span style="margin-top:100px;" v-if="authorsNewOpen"/>
                <div class="modal-wrapper" style="margin-top:20px; margin-bottom:15px;">
                    <h3 class="title">出版社登録フォーム</h3>
                    <div class="form-container" style="padding-top:0; padding-bottom:0;">
                        <form method="POST" action="/api/book/register" enctype="multipart/form-data">
                            <input type="hidden" name="_token" :value="csrf" />
                            <table class="title-area">
                                <label class="label">書籍タイトル</label><br />
                                <input type="text" name="name" class="input_text" value="イシューからはじめよ 知的生産の「シンプルな本質」"/><br />
                            </table>
                            <!-- 著者 -->
                            <table class="author-select-area">
                                <!-- 既存の著者から選択 -->
                                <label class="label">著者</label><br />
                                <!-- 各入力ボックス -->
                                <select class="author-select" :name="'authors['+ index + ']'"
                                    v-for="(text,index) in authors_select" :key="index">
                                    <option disabled value="" selected>選択してください</option>
                                    <option v-for="author in authors"
                                        v-bind:value="author.id"
                                        v-bind:key="author.id">
                                        {{ author.name }}
                                    </option>
                                </select>
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
                                <table class="author-new-area" v-if="authorsNewOpen">
                                    <label class="label">新規著者</label><br />
                                    <!-- 新規著者名入力欄 -->
                                    <table v-for="(author_new,index) in authors_new" :key="index">
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
                                    </table>
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
                                </table>
                            </table>

                            <!-- 出版社 -->
                            <table class="publisher-select-area">
                                <label class="label">出版社</label>
                                <div class="publisher_input_area" v-if="!publisherNewOpen">
                                    <select class="publisher-select" name="publisher_id" >
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
                                <table class="publisher-new-area">
                                    <div class="publisher_input_area" v-if="publisherNewOpen">
                                        <input type="text" name="publisher_name" class="input_text" placeholder="新規出版社名" />
                                        <input type="text" name="publisher_name_furigana" class="input_text" placeholder="新規出版社名（ふりがな）" />
                                    </div>
                                </table>
                                <hr />
                                <p class="switch-text" v-if="publisherNewOpen" @click="publisherNewOpen=false">登録済みの出版社を選択する</p>
                                <p v-if="!publisherNewOpen" @click="publisherNewOpen=true">または新規出版社を登録する</p>
                            </table>

                            <!-- 初版発行時期 -->
                            <table class="first_publish-area">
                                <label class="label">初出版</label><br />
                                <flat-pickr class="first_publish-input" v-model="date" name="first_published" :config="flatOption"/><br />
                            </table>
                            <!-- 表紙 -->
                            <table class="image-area">
                                <label class="label">表紙画像</label><br />
                                <input class="image-btn" type="file" name="book_image" /><br />
                                <br />
                            </table>

                            <input type="submit" class="submit-button">
                        </form>
                    </div>
                    <p class="close-text" @click="modalOpen=false, changeScrollable()">閉じる</p>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import {Japanese} from 'flatpickr/dist/l10n/ja.js';

export default {
    name: "TeleportSample1",
    props: {
        msg: String
    },
    components: {
        flatPickr
    },
    data() {
        return {
            authors_select: [''],
            authors_new: [],
            modalOpen: false,
            publisherNewOpen: false,
            authorsNewOpen: false,
            date: null,
            publishers: [],
            authors: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            flatOption:{
                locale: Japanese,
            },
        }
    },
    methods:{
        // スクロールができるようにもどす
        changeScrollable() {
            window.scrollTo({
                top: 0,          //上からの位置
                left: 0,         //左からの位置
                behavior: 'smooth' //smoothでスクロールしながら移動
            });
            let element = document.querySelector('body');
            element.style.overflow = 'scroll';
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

        // 出版社一覧を取得する
        getPublisherIndex() {
            axios.get('/api/publisher/index-json')
                .then((res) =>{
                    this.publishers = res.data;
                });
        },
        // 著者一覧を取得する
        getAuthorIndex() {
            axios.get('/api/author/index-json')
                .then((res) =>{
                    this.authors = res.data;
                });
        }
    },
    mounted () {
        this.getPublisherIndex();
        this.getAuthorIndex();
    },
}
</script>

<style scoped>
    /* モーダル */
    .modal {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background-color: rgba(0,0,0,.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: auto;
        overflow: auto;
    }

    .modal div {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: white;
        width: 480px;
        /* height: 275px; */
        padding: 15px;
        padding-bottom: 25px;
    }

    .publisher_input_area {
        align-items: start !important;
        justify-content: start !important;
        width: auto !important;
        height: auto !important;
        padding: 0 !important;
    }

    .form-container {
        padding-top: 0;
        width: 80%;
    }

    .title-area,
    .author-select-area,
    .author-new-area,
    .publisher-select-area,
    .publisher-new-area,
    .first_publish-area,
    .image-area {
        margin-bottom: 10px;
    }

    .title {
        margin-top: 10px;
    }

    .label {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .input_text {
        width: 400px;
        font-size: 16px;
        margin-top: 5px;
    }

    .switch-text {
        font-size: 16px;
        margin-top:5px;
    }

    .author-select,
    .publisher-select,
    .first_publish-input,
    .image-btn{
        margin-top: 5px;
    }

    .submit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        margin-bottom: 10px;
        width:144px;
        height:40px;
        border-radius: 5%;
        border: none;
        background-color: #0c2e8f;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
        cursor:pointer
    }

    .close-text {
        color:#0c2e8f;
        text-decoration: underline;
        cursor:pointer
    }

    /* モーダル表示ボタン */
    button{
        background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0;
        appearance: none;
    }

    .register-button {
        width: 100%;
        height: 100%;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
    }

</style>
