<template>
    <div>
        <button class="edit-button" @click="modalOpen = true; getAuthorDetail(author_id);">
            編集・削除
        </button>

        <teleport to="body">
            <div v-if="modalOpen" class="modal">
                <div class="modal-wrapper">
                    <h3 class="title">著者編集フォーム</h3>
                    <div class="form-container" style="padding-top:0; padding-bottom:0;">
                        <!-- 編集フォーム -->
                        <form method="POST" v-bind:action="'api/author/edit/' + author.id" >
                            <input type="hidden" name="_token" :value="csrf" />
                            <label class="label">著者名</label><br />
                            <input type="text" name="name" class="name-input" v-model="author.name" /><br />
                            <label class="label">著者名（ふりがな）</label><br />
                            <input type="text" name="name_furigana" class="name-furigana-input" v-model="author.name_furigana" />
                            <br />

                            <input type="submit" class="submit-button" />
                        </form>
                        <!-- 削除ボタン -->
                        <button class="delete-button" @click="deleteAuthor(author.id, csrf)">
                            削除
                        </button>
                    </div>
                    <p class="close-text" @click="modalOpen = false">閉じる</p>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script>
    export default {
        props: {
            msg: String,
            'author_id': {
                type: Number,
                default: null
            },
        },
        data() {
            return {
                modalOpen: false,
                author:[],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{
            getAuthorDetail(author_id) {
                axios.get('/api/author/detail-json/' + author_id)
                    .then((res) =>{
                        this.author = res.data;
                    });
            },
            deleteAuthor(author_id, csrf) {
                if (window.confirm("この著者情報を削除しますか？")) {
                    var send_data = new XMLHttpRequest();
                    send_data.open('POST', 'api/author/delete/' + author_id);
                    send_data.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
                    send_data.send('_token=' + csrf);
                    window.alert('著者情報を削除しました');
                    window.location.reload();
                }
            },
        mounted () {
            this.getAuthorDetail();
        }
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
        height: 320px;
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

    .name-input, .name-furigana-input {
        width: 250px;
        font-size: 16px;
        margin-bottom: 20px;
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

    .edit-button {
        width: 100%;
        height: 100%;
        color: #0c2e8f;
        text-decoration: underline;
        cursor:pointer;
        font-size: 18px;
    }

</style>
