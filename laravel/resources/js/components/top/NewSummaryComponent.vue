<template>
    <div class="new-summary">
        <div class="container-box">
            <h3 class="title">最近追加された要約</h3>
            <div class="chapter-latest-container">
                <ul>
                    <li class="chapter-latest-one"
                        v-for="(chapter, index) in chapters" :key="index">
                        <table>
                            <tr scope="row">
                                <th class="book-title">
                                    <a class="book-link"
                                        v-bind:href="'/book/detail/' + chapter.book.id ">
                                        {{ chapter.book.name }}
                                    </a>
                                </th>
                            </tr>
                            <tr>
                                <td class="chapter-title">
                                    <h5 class="page-link-title">「{{ chapter.title }}」</h5>
                                </td>
                            </tr>
                            <tr>
                                <td class="chapter-summary">
                                    <p>{{ chapter.summary }}</p>
                                </td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data:function(){
        return {
            msg:'wait...',
            chapters:[],
        };
    },
    methods:{
        getChaptersLatest() {
            axios.get('/api/chapter/latest-json')
                .then((res) =>{
                    this.chapters = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getChaptersLatest();
    },
}
</script>

<style>
    .new-summary {
        width:100%;
        /* height:150px; */
        padding: 10px;
        background-color: #fafafa;
    }

    .chapter-latest-container {
        width: 80%;
        padding: 20px;
        margin: 0 auto;
    }

    .chapter-latest-one {
        /* display: flex; */
        width: 100%;
        padding: 15px;
        border: solid black;
        border-radius: 3%;
        margin-bottom: 10px;
    }

    .book-title,
    .chapter-title,
    .chapter-summary {
        text-align: left;
    }

    .book-link {
        text-decoration:none;
        color: #fafafa;
        text-align: left;
    }
</style>
