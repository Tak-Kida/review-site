<template>
    <div class="wrap">
        <HeaderComponent></HeaderComponent>

        <router-view></router-view>

        <footer class="footer">
            <p>footer</p>
        </footer>
    </div>
</template>

<script>
import Sample from './components/Sample.vue'
import TestPage01 from './components/TestPage01.vue'
import TestPage02 from './components/TestPage02.vue'
import HeaderComponent from './components/HeaderComponent.vue'
import BookIndex from './pages/books/BookIndex.vue'

export default {
  name: 'app',
  components: {
    TestPage01,
    TestPage02,
    BookIndex,
    Sample,
    HeaderComponent
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
