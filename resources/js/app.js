import './webpack-setup';

import App from './App';
import Vue from 'vue';
import VueMeta from 'vue-meta';
import VueRouter from 'vue-router';

Vue.use(VueMeta);
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: document.body.dataset.baseUrl,
    routes: require('./routes').default,
});

new Vue({
    ...App,
    el: '#app',
    router,
});
