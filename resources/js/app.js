require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';


import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect)

Vue.use(VueRouter);

// register globally
// Vue.component('multiselect', Multiselect);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import schedule from './components/schedule.vue';
import beeinsert from './components/beeinsert.vue';
import flowerinsert from './components/flowerinsert.vue';

const routes = [
    { path: '/', component: schedule},
    { path: '/beeinsert', name: 'beeinsert', component: beeinsert},
    { path: '/flowerinsert', name: 'flowerinsert', component: flowerinsert}
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    router: router,
    axios: axios,
    // render: h => h(App)
});