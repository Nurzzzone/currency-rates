import Vue from 'vue';
import router from './router';

require('./bootstrap');

Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('currencies-rates-component', require('./components/CurrenciesRatesComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});