
require('./bootstrap');

import Top from './components/Top.vue';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: "/",
        component: Top
    }
];

const router = createRouter({
    routes, // short for `routes: routes`
    history: createWebHistory(),
})

const app = createApp({
    components: {
        Top
    }
});

app.use(router);
app.mount('#app');




