/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import index from "./store";
import router from "./routes";
import Vuetify from "vuetify";
import colors from "vuetify/lib/util/colors";
import Vue2Filters from 'vue2-filters';
import vueCountryRegionSelect from 'vue-country-region-select';

const vuetify = new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "#03A9F4",
                secondary: "#039BE5",
                accent: '#FFC107',
                error: colors.red.accent3,
            },
            dark: {
                primary: colors.blue.lighten3,
            },
        },
        dark:true
    },
});

Vue.use(Vuetify);
Vue.use(Vue2Filters)
Vue.use(vueCountryRegionSelect)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('layout-component', require('./components/LayoutComponent.vue').default);
Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('delete-dialog-component', require('./components/DeleteDialogComponent.vue').default);
Vue.component('products-component', require('./components/site/ProductsComponent.vue').default);
Vue.component('checkout-component', require('./components/site/CheckoutComponent.vue').default);
Vue.component('login-component', require('./components/secure/LoginComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: index,
    router: router,
    vuetify: vuetify
});
