<template>
    <main class="main">
        <div class="content-wrapper">
            <!-- 最新の書籍 -->
            <BookRecentArrival></BookRecentArrival>

            <!--最近追加された要約 -->
            <NewSummary></NewSummary>

            <!-- 各ページへのリンク -->
            <PageLink></PageLink>
        </div>
    </main>
</template>

<script>
import BookRecentArrival from '../components/top/BookRecentArrivalComponent.vue'
import NewSummary from '../components/top/NewSummaryComponent.vue'
import PageLink from '../components/top/PageLinkComponent.vue'

export default {
  components: {
    BookRecentArrival,
    NewSummary,
    PageLink
},
//   data() {
//     return {
//       activePage: 'test-page01'
//     }
//   },
//   methods: {
//     setPage(page) {
//        this.activePage = page;
//     }
//   }
}
</script>


<style>

</style>
