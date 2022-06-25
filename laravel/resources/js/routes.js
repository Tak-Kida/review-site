import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import TopPage from './pages/TopPage.vue'
// Book
import BookIndex from './pages/books/index.vue'
import BookDetail from './pages/books/detail.vue'
import BookRegister from './pages/books/register.vue'
import BookEdit from './pages/books/edit.vue'
// Author
import AuthorIndex from './pages/authors/index.vue'
import AuthorRegister from './pages/authors/register.vue'
import AuthorEdit from './pages/authors/edit.vue'
// Publisher
import PublisherIndex from './pages/publishers/index.vue'
import PublisherRegister from './pages/publishers/register.vue'
import PublisherEdit from './pages/publishers/edit.vue'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        // root
        { path: '/',            name: 'root',  component: TopPage },
        // book
        { path: '/book',            name: 'book-index',    component: BookIndex },
        { path: '/book/register',   name: 'book-register', component: BookRegister },
        { path: '/book/detail/:id',
            name: 'book-detail',
            component: BookDetail,
            props: router => ({ id: Number(router.params.id) })
        },
        { path: '/book/edit/:id',
            name: 'book-edit',
            component: BookEdit,
            props: router => ({ id: Number(router.params.id) })
        },

        // author
        { path: '/author',        name: 'author-index',   component: AuthorIndex },
        { path: '/author/register',   name: 'author-register', component: AuthorRegister },
        { path: '/author/edit/:id',
            name: 'author-edit',
            component: AuthorEdit,
            props: router => ({ id: Number(router.params.id) })
        },

        // publisher
        { path: '/publisher',        name: 'publisher-index',   component: PublisherIndex },
        { path: '/publisher/register',   name: 'publisher-register', component: PublisherRegister },
        {   path: '/publisher/edit/:id',
            name: 'publisher-edit',
            component: PublisherEdit,
            props: router => ({ id: Number(router.params.id) })
        },
    ],
    linkActiveClass: 'example-active',
    linkExactActiveClass: 'example-exact-active',
  })

export default router;
