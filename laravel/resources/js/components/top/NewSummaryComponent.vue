<template>
    <div class="new-summary">
        <div class="container-box">
            <div class="title-box">
                <h3 class="title">最近追加された要約</h3>
            </div>
            <div>
                <!-- <tr v-for="(book, index) in books" :key="index">
                    <th scope="row">{{ book.id }}</th>
            +       <td>{{ book.name }}</td>
                    <td><a v-bind:href="'/book/detail/' + book.id ">詳細</a></td>
                </tr> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data:function(){
        return {
            msg:'wait...',
            books:[],
        };
    },
    methods:{
        getBookIndex() {
            axios.get('/api/book/index-json')
                .then((res) =>{
                    this.books = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getBookIndex();
    },
}
</script>

<style>
.new-summary {
    width:100%;
    height:150px;
    padding: 10px;
    background-color: #fafafa;
}
</style>
