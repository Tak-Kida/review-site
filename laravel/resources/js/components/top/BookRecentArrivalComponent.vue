<template>
    <div class="book-latest">
        <div class="container-box">
            <h3 class="title">最近追加された書籍</h3>
            <div class="book-latest-container">
                <carousel :items-to-show="1">
                    <slide class="book-slide"
                        v-for="(book, index) in books" :key="index">
                        <div class="book-slide-one">
                            <img
                                class="book-image"
                                href="book/detail/{{ book.id }}"
                                :src="'/storage/book_image/' + book.image_name"
                                :alt= "book.name"  />
                            <h5 class="book-name">
                                <a class="book-name-link" :href="'book/detail/' + book.id ">
                                    {{ book.name }}
                                </a>
                            </h5>
                            <ul>
                                <li class="author" v-for="(book_author, index) in book.book_authors" :key="index">
                                    {{ book_author.author.name }}（{{ book_author.author.name_furigana }}）
                                </li>
                            </ul>
                            <p>{{ book.publisher.name }}</p>
                        </div>
                    </slide>

                    <template #addons>
                        <navigation />
                        <pagination />
                    </template>
                </carousel>
            </div>
        </div>
    </div>
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
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
        background-color: #fafafa;
    }

    .book-latest-container {
        width: 80%;
        padding: 20px;
        margin: 0 auto;
    }

    .slide-page {
        display: flex;
    }

    .carousel__prev,
    .carousel__next {
        background-color: #0c2e8f;
        color: #fafafa;
    }

    .carousel__pagination-button--active {
        background-color: #0c2e8f;
    }
</style>
