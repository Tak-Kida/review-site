<template>
    <div class="wrap">
        <HeaderComponent></HeaderComponent>

        <router-view></router-view>

        <FooterComponent></FooterComponent>
    </div>
</template>

<script>
import HeaderComponent from './components/HeaderComponent.vue'
import FooterComponent from './components/FooterComponent.vue'
import BookIndex from './pages/books/index.vue'

export default {
  name: 'app',
  components: {
    BookIndex,
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

<style>

/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

/* 共通CSS */
.main {
    background-color: #fafafa;
}

.content-wrapper {
    width: 90%;
    margin: 0 auto;
    padding: 10px 0;
    /* max-width: none;
    min-width: none; */
}

.container-box {
    width: 100%;
}

.title {
    position: relative;
    top: 0;
    left: 0;
    font-size: 24px;
    border-bottom: 3px solid #0c2e8f;
    margin-bottom: 10px;
}

.title::before {
    position: absolute;
    bottom: 0;
    content: '';
    width: auto;
}

</style>
