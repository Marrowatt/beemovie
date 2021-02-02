require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Multiselect from 'vue-multiselect'

Vue.component('multiselect', Multiselect)
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueRouter);

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import schedule from './components/schedule.vue';
import beeinsert from './components/beeinsert.vue';
import flowerinsert from './components/flowerinsert.vue';

const routes = [
    { path: '/', component: schedule},
    { path: '/beeinsert', name: 'beeinsert', component: beeinsert},
    { path: '/flowerinsert', name: 'flowerinsert', component: flowerinsert}
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    router: router,
    axios: axios,
});