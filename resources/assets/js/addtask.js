/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// css files
//import 'va/lib/css'

// js files
//import 'va/lib/script'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*import VueBsDrawer from 'vue-bs-drawer'

Vue.component('bs-drawer', VueBsDrawer)*/

Vue.component('navbar-component', require('./components/NavbarComponent.vue'));
Vue.component('sidebar-component', require('./components/SidebarComponent.vue'));
Vue.component('addtask-component', require('./components/AddtaskComponent2.vue'));
//Vue.component('calendar-component', require('./components/CalendarComponent.vue'));

import { Navbar, Layout } from 'bootstrap-vue/es/components';

Vue.use(Layout);
Vue.use(Navbar);

const app = new Vue({
    el: '#app'
});