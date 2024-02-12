import './bootstrap';
// import '../css/style.css';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'

import VueGoodTablePlugin from 'vue-good-table-next';
// datatable css
import 'vue-good-table-next/dist/vue-good-table-next.css'
// v-select
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import './helpers.js';
import './sweetalert2.js';
import { numericOnlyDirective } from './helpers.js';
// for vue-good-table dark mode set globally
import darkModePlugin from './darkModePlugin.js';
import { createApp } from 'vue';
import App from './App.vue'
import router from '@/routes';
import { createPinia } from 'pinia';
const pinia = createPinia();

const app = createApp(App);
app.component("v-select", vSelect)
app.directive('numericOnly', numericOnlyDirective);
app.use(LaravelPermissionToVueJS)
app.use(VueGoodTablePlugin);
app.use(darkModePlugin);
app.use(router);
app.use(pinia);
app.mount('#app');

