<template>
    <div class="wrap">
        <HeaderComponent></HeaderComponent>

        <router-view></router-view>

        <FooterComponent></FooterComponent>
    </div>
</template>

<script>
import Sample from './components/Sample.vue'
import HeaderComponent from './components/HeaderComponent.vue'
import FooterComponent from './components/FooterComponent.vue'
import BookIndex from './pages/books/index.vue'

export default {
  name: 'app',
  components: {
    BookIndex,
    Sample,
    HeaderComponent,
    FooterComponent
},
  data() {
    return {
      activePage: 'test-page01'
    }
  },
  methods: {
    setPage(page) {
       this.activePage = page;
    }
  }
}
</script>
