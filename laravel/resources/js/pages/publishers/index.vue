<template>
    <main class="main">
        <div class="content-wrapper">
            <div class="top-container">
                <h3 class ="title">登録済み出版社名一覧</h3>
                <div class="search-container">
                    <p class="loading-message">{{ msg }}</p>
                    <PublisherRegisterModal class="link-box-end" />
                </div>
            </div>
            <hr />
            <div class="publisher-container">
                <table class="publisher-table">
                    <thead class="table-header">
                        <tr>
                            <th>id</th>
                            <th>出版社名</th>
                            <th>出版社名(ふりがな)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(publisher, index) in publishers" :key="index">
                            <td scope="row">{{ publisher.id }}</td>
                            <td class="publisher-name">{{ publisher.name }}</td>
                            <td class="publisher-name-furigana">{{ publisher.name_furigana }}</td>
                            <!-- <td><a v-bind:href="'/publisher/edit/' + publisher.id ">編集・削除</a></td> -->
                            <td><PublisherEditModal :publisher_id="publisher.id" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr />
            <div class="bottom-container">
                <div></div>
                <PublisherRegisterModal class="link-box-end" />
            </div>
        </div>
    </main>
</template>

<script>
import PublisherRegisterModal from "../../components/publisher/PublisherRegisterModal";
import PublisherEditModal from "../../components/publisher/PublisherEditModal";

export default {
    components: {
        PublisherRegisterModal,
        PublisherEditModal
    },
    data:function(){
        return {
            msg:'データ取得中...',
            publishers:[],
        };
    },
    methods:{
        getPublisherIndex() {
            axios.get('api/publisher/index-json')
                .then((res) =>{
                    this.publishers = res.data;
                    this.msg = '登録されている出版社は以下のとおりです';
                });
        }
    },
    mounted () {
        this.getPublisherIndex();
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

.publisher-container {
    display: flex;
    width: 100%;
}

.publisher-table {
    margin: 0 auto;
    width: 80%;
}

th {
    padding: 10px;
    background-color: #0c2e8f;
    font-size: 24px;
    color: #fafafa;
}

td{
    text-align: center;
    vertical-align: middle;
    padding: 10px;
    font-size: 20px;
}

</style>
