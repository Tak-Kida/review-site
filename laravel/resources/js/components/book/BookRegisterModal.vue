<template>
    <div>
        <button class="register-button" @click="modalOpen = true">
            新規登録
        </button>

        <teleport to="body">
            <div v-if="modalOpen" class="modal">
                <div class="modal-wrapper">
                    <h3 class="title">出版社登録フォーム</h3>
                    <div class="form-container" style="padding-top:0; padding-bottom:0;">
                        <form method="POST" action="/api/book/register" enctype="multipart/form-data">
                            <input type="hidden" name="_token" :value="csrf" />
                            <label class="label">書籍タイトル</label><br />
                            <input type="text" name="name" class="input_text" value="イシューからはじめよ 知的生産の「シンプルな本質」"/><br />
                            <!-- 著者 -->
                            <label class="label">著者</label><br />
                            <!-- 各入力ボックス -->
                            <select :name="'authors['+ index + ']'"
                                v-for="(text,index) in texts" :key="index"
                                v-model="texts[index]"
                            >
                                <option disabled value="">選択してください</option>
                                <option v-for="author in authors"
                                    v-bind:value="author.id"
                                    v-bind:key="author.id">
                                    {{ author.name }}
                                </option>
                            </select>
                            <br />
                            <!-- 入力ボックスを追加するボタン -->
                            <button type="button" @click="addInput()">追加する</button>
                            <br />
                            <!-- 入力ボックスの削除ボタン -->
                            <button type="button" @click="removeInput(index)">削除</button>
                            <br />

                            <!-- <select name="authors[0]">
                                <option disabled value="">選択してください</option>
                                <option v-for="author in authors"
                                    v-bind:value="author.id"
                                    v-bind:key="author.id">
                                    {{ author.name }}
                                </option>
                            </select> -->
                            <label class="label">新規著者</label><br />

                            <!-- 新規著者名入力欄 -->
                            <!-- <input type="text" name="author_new_name[0]" class="input_text" value=""/><br /> -->
                            <input type="text" :name="'author_new_name['+ index + ']'"
                                class="input_text"
                                v-for="(text,index) in texts" :key="index"
                                v-model="texts[index]"
                            />
                            <br />
                            <!-- 新規著者名ふりがな入力欄 -->
                            <!-- <input type="text" name="author_new_name_furigana[0]" class="input_text" value=""/><br /> -->
                            <input type="text" :name="'author_new_name_furigana['+ index + ']'"
                                class="input_text"
                                v-for="(text,index) in texts" :key="index"
                                v-model="texts[index]"
                            />
                            <br />
                            <!-- 入力ボックスを追加するボタン -->
                            <button type="button" @click="addInput()">追加する</button>
                            <br />
                            <!-- 入力ボックスの削除ボタン -->
                            <button type="button" @click="removeInput(index)">削除</button>
                            <br />

                            <!-- 出版社 -->
                            <label class="label">出版社</label>
                            <div class="publusher_input_area" v-if="!publisherNewOpen">
                                <select name="publisher_id" >
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
                            <!-- <label class="label" v-if="publisherNewOpen">新規出版社</label><br /> -->
                            <div class="publusher_input_area" v-if="publisherNewOpen">
                                <input type="text" name="publisher_name" class="input_text" placeholder="新規出版社名" />
                                <input type="text" name="publisher_name_furigana" class="input_text" placeholder="新規出版社名（ふりがな）" />
                            </div>
                            <p v-if="!publisherNewOpen" @click="publisherNewOpen=true">または新規出版社を登録する</p>
                            <p v-if="publisherNewOpen" @click="publisherNewOpen=false">登録済みの出版社を選択する</p>
                            <!-- 初版発行時期 -->
                            <label class="label">初出版</label><br />
                            <!-- <input type="text" name="first_published" class="input_text" value="2010-11-01" /><br /> -->
                            <flat-pickr v-model="date" name="first_published" :config="flatOption"/><br />
                            <!-- 表紙 -->
                            <label class="label">表紙画像</label><br />
                            <input type="file" name="book_image" /><br />
                            <br />

                            <input type="submit" class="submit-button">
                        </form>
                    </div>
                    <p class="close-text" @click="modalOpen = false">閉じる</p>
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
            texts: [''],

            modalOpen: true,
            publisherNewOpen: false,
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
        // ボタンをクリックしたときのイベント ③
        removeInput(index) {

            this.texts.splice(index, 1); // 👈 該当するデータを削除

        },
        // ボタンをクリックしたときのイベント ③
        addInput() {

            if(this.isTextMax) {
                return;
            }
            this.texts.push(''); // 配列に１つ空データを追加する
            Vue.nextTick(() => {
                const maxIndex = this.texts.length - 1;
                console.log(maxIndex)
                this.$refs['texts'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする

            });
        },


        getPublisherIndex() {
            axios.get('/api/publisher/index-json')
                .then((res) =>{
                    this.publishers = res.data;
                });
        },
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

    .publusher_input_area {
        /* display: flex;
        flex-direction: column; */
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

    .title {
        margin-top: 10px;
        margin-bottom: 0;
    }

    .label {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .input_text {
        width: 250px;
        font-size: 16px;
        /* margin-bottom: 20px; */
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
