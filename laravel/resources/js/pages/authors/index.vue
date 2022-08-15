<template>
    <main class="main">
        <div class="content-wrapper">
            <div class="top-container">
                <h3 class ="title">登録済み著者名一覧</h3>
                <div class="search-container">
                    <p class="loading-message">{{ msg }}</p>
                    <AuthorRegisterModal class="link-box-end" />
                </div>
            </div>
            <hr />
            <div class="publisher-container">
                <table class="publisher-table">
                    <thead class="table-header">
                        <tr>
                            <th>id</th>
                            <th>著者名</th>
                            <th>著者名(ふりがな)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(author, index) in authors" :key="index">
                            <td scope="row">{{ author.id }}</td>
                            <td class="publisher-name">{{ author.name }}</td>
                            <td class="publisher-name-furigana">{{ author.name_furigana }}</td>
                            <td><AuthorEditModal :author_id="author.id" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr />
            <div class="bottom-container">
                <div></div>
                <AuthorRegisterModal class="link-box-end" />
            </div>
        </div>
    </main>
</template>

<script>
import AuthorRegisterModal from "../../components/author/AuthorRegisterModal";
import AuthorEditModal from "../../components/author/AuthorEditModal";

export default {
    data:function(){
        return {
            msg:'データ取得中...',
            authors:[],
        };
    },
    components: {
        AuthorRegisterModal,
        AuthorEditModal
    },
    methods:{
        getAuthorIndex() {
            axios.get('/api/author/index-json')
                .then((res) =>{
                    this.authors = res.data;
                    this.msg = '登録されている著者は以下のとおりです';
                });
        }
    },
    mounted () {
        this.getAuthorIndex();
    },
}
</script>
