import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import TestPage01 from './components/TestPage01.vue';
import TestPage02 from './components/TestPage02.vue';
import TopPage from './pages/TopPage.vue'
import BookIndex from './pages/books/BookIndex.vue'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        // { path: '/', redirect: '/test-page01' },
        { path: '/',            name: 'root',  component: TopPage },
        { path: '/book',        name: 'book',   component: BookIndex },
        { path: '/test-page01', name: 'test1',  component: TestPage01 },
        { path: '/test-page02', name: 'test2',  component: TestPage02 },
    ],
    linkActiveClass: 'example-active',
    linkExactActiveClass: 'example-exact-active',
  })

export default router;
