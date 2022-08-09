<template>
    <div>
        <button class="register-button-text" @click="modalOpen = true">
            新規登録
        </button>

        <teleport to="body">
            <div v-if="modalOpen" class="modal">
                <div class="modal-wrapper">
                    <h3 class="title">出版社登録フォーム</h3>
                    <div class="form-container" style="padding-top:0;">
                        <form method="POST" action="/api/publisher/register" >
                            <input type="hidden" name="_token" :value="csrf" />
                            <label class="label">出版社名</label><br />
                            <input type="text" name="name" class="name-input" /><br />
                            <label class="label">出版社名（ふりがな）</label><br />
                            <input type="text" name="name_furigana" class="name-furigana-input" />
                            <br />

                            <input type="submit" class="submit-button">
                        </form>
                    </div>
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
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }
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
        height: 275px;
        padding: 15px;
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
        background-color: #0c2e8f;
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
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

    .register-button-text {
        color: #fafafa;
        text-decoration:none;
        font-weight: 800;
        font-size: 16px;
    }

</style>
