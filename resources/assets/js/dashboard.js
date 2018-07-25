/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// css files
//import 'va/lib/css';

// js files
//import 'va/lib/script';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('navbar-component', require('./components/NavbarComponent1.vue'));
//Vue.component('test-component', require('./components/Test.vue'));

// js files
//import 'va/lib/script'


const app = new Vue({
    el: '#appVue'
});