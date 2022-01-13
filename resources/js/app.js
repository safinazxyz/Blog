require('./bootstrap');
window.Vue = require('vue');

import Vue2Editor from 'vue2-editor';
Vue.use(Vue2Editor);

//Vuex
import Vuex from 'vuex'
Vue.use(Vuex);
import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
);

//Moment JS Plugin
import {filter} from './filter'

//Vue Router
import VueRouter from "vue-router"
Vue.use(VueRouter)

import {routes} from './routes'

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin', require('./components/admin/AdminDashboard.vue').default);
Vue.component('frontend', require('./components/frontend/FrontendMaster.vue').default);
//V-form
import {Form, HasError, AlertError} from 'vform'

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form = Form;

//Text Editor
import Nl2br from 'vue-nl2br'
Vue.component('nl2br', Nl2br)

//Sweet Alert 2
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

const router = new VueRouter({
    mode: 'hash',
    routes, //short for 'routes: routes'

});
const app = new Vue({
    el: '#app',
    router,
    store
});
