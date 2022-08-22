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
                            <select name="authors[0]">
                                <option disabled value="">選択してください</option>
                                <option v-for="author in authors"
                                    v-bind:value="author.id"
                                    v-bind:key="author.id">
                                    {{ author.name }}
                                </option>
                            </select>
                            <br />
                            <label class="label">新規著者</label><br />
                            <input type="text" name="author_new_name" class="input_text" value=""/><br />
                            <!-- 出版社 -->
                            <label class="label">出版社</label><br />
                            <!-- <input type="text" name="publisher_id" class="input_text" value=1 /><br /> -->
                            <select name="publisher_id">
                                <option disabled value="">選択してください</option>
                                <option v-for="publisher in publishers"
                                    v-bind:value="publisher.id"
                                    v-bind:key="publisher.id">
                                    {{ publisher.name }}
                                </option>
                            </select>
                            <br />
                            <label class="label">新規出版社</label><br />
                            <input type="text" name="publisher_name" class="input_text" value=""/><br />

                            <label class="label">初出版</label><br />
                            <input type="text" name="first_published" class="input_text" value="2010-11-01" /><br />

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
    export default {
        name: "TeleportSample1",
        props: {
            msg: String
        },
        data() {
            return {
                modalOpen: false,
                publishers: [],
                authors: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{
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
        margin-bottom: 20px;
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
