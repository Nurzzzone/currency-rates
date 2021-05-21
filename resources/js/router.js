import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home';
import Login from './components/LoginComponent';
import Register from './components/RegisterComponent';
import CurrenciesRates from './components/CurrenciesRatesComponent';
import CurrencyRateHistory from './components/CurrencyComponent';

Vue.use(VueRouter);


export default new VueRouter({
  mode: 'history',
  routes: [
    { 
        path: '/',
        name: 'home',
        meta: { requireAuth: true },
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/currencies',
        name: 'currencies',
        meta: { requireAuth: true },
        component: CurrenciesRates,
    },
    {
        path: '/currencies/history/:id',
        name: 'currency_history',
        meta: { requireAuth: true },
        component: CurrencyRateHistory
    },
  ],
});