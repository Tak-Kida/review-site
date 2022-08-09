<template>
    <div>
        <button @click="modalOpen = true">
            モーダルを開く
        </button>

        <teleport to="body">
            <div v-if="modalOpen" class="modal">
                <div>
                    モーダルの中身<br>
                    {{ msg }}
                    <button @click="modalOpen = false">
                        閉じる
                    </button>
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
                modalOpen: false
            }
        }
    }
</script>

<style scoped>
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
        width: 300px;
        height: 300px;
        padding: 5px;
    }

    button{
        background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0;
        appearance: none;
    }
</style>
