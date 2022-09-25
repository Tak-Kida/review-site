<template>
    <div class="book-latest">
        <div class="container-box">
            <h3 class="title">最新のまとめ</h3>
            <div class="book-latest-container">
                <tr v-for="(book, index) in books" :key="index">
                    <th scope="row">{{ index }}</th>
            +       <td>{{ book.name }}</td>
                    <td><a v-bind:href="'/book/detail/' + book.id ">詳細</a></td>
                </tr>
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
        getBookLatest() {
            axios.get('/api/book/latest-json')
                .then((res) =>{
                    this.books = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getBookLatest();
    },
}
</script>

<style>
    .book-latest {
        width:100%;
        height:300px;
        background-color: #fafafa;
    }

    .book-latest-container {
        display: flex;
    }
</style>
