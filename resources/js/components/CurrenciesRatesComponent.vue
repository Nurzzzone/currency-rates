<template>
  <div class="card">
      <div class="card-header pl-2 bg-white d-flex align-items-center">
            <h5 class="m-0">Available currency exchange rates</h5>
      </div>
      <div class="card-body p-0" v-if="currencies.length > 0">
        <table class="table table-hover m-0">
            <thead>
                <tr>
                    <th class="font-small-2 border-bottom-0 border-top-0">
                        <div class="d-flex align-items-center">
                            <span>From</span>
                            <input class="ml-2 form-control form-control-sm" type="text" v-model="keyword_from">
                        </div>
                    </th>
                    <th class="font-small-2 border-bottom-0 border-top-0">
                        <div class="d-flex align-items-center">
                            <span>To</span>
                            <input class="ml-2 form-control form-control-sm" type="text" v-model="keyword_to">
                        </div>
                    </th>
                    <th class="font-small-2 border-bottom-0 border-top-0">
                        <span class="d-inline-block">Exchange Rate (amount: 1)</span>
                    </th>
                    <th class="font-small-2 border-bottom-0 border-top-0">
                        <span class="d-inline-block">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(currency, index) in currencies" :key="index">
                    <td v-text="currency.from"></td>
                    <td v-text="currency.to"></td>
                    <td v-text="currency.rate"></td>
                    <td>
                        <router-link :to="{path: 'currencies/history/' + currency.id}">view</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="card-footer bg-white">
        <nav aria-label="pagination" class="d-flex justify-content-between align-items-center">
            <div>
                <p class="m-0" v-text="`From ${from} to ${to} (${total})`"></p>
            </div>
            <ul class="pagination m-0">
                <li class="page-item">
                    <button v-on:click="getPage(pagination.first_page)" :disabled="!pagination.first_page" type="button" class="btn page-link">
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
                <li class="page-item" v-if="!pagination.current_page === 1">
                    <button v-on:click="getPage(pagination.next_page)" v-text="`${pagination.current_page - 1}`" type="button" class="btn page-link">
                    </button>
                </li>
                <li class="page-item" v-if="pagination.current_page > 1">
                    <button v-on:click="getPage(pagination.prev_page)" v-text="`${pagination.current_page - 1}`" type="button" class="btn page-link">
                    </button>
                </li>
                <li class="page-item">
                    <button disabled v-text="`${pagination.current_page}`" type="button" class="btn page-link">
                    </button>
                </li>
                <li class="page-item" v-if="pagination.next_page">
                    <button v-on:click="getPage(pagination.next_page)" v-text="`${pagination.current_page + 1}`" type="button" class="btn page-link">
                    </button>
                </li>
                <li class="page-item" v-if="pagination.current_page === 1 && thirdPage">
                    <button v-on:click="getPage(thirdPage)" v-text="`${pagination.current_page + 2}`" type="button" class="btn page-link">
                    </button>
                </li>
                <li class="page-item">
                    <button v-on:click="getPage(pagination.last_page)" :disabled="!pagination.last_page" class="btn page-link">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
            </ul>
        </nav>
      </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                keyword_from: null,
                keyword_to: null,
                url: '/api/v1/currencies',
                currencies: [],
                pagination: {},
                total: 0,
                from: 0,
                to: 0,
                thirdPage: '/api/v1/currencies?page=3',
            }
        },
        mounted() {
            this.getCurrencies();
        },
        watch: {
            keyword_from(after, before) {
                this.findFromCurrencies();
            },
            keyword_to(after, before) {
                this.findToCurrencies();
            },
        },
        methods: {
            getCurrencies() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                        axios.get(this.url, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.status === 200) {
                                this.currencies = response.data.data;
                                this.total = response.data.total
                                this.from = response.data.from
                                this.to = response.data.to
                                this.makePagination(response);
                            }
                        })
                        .catch(error => console.log(error));
                });
            },
            findFromCurrencies() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('/api/v1/currencies/search/from', {params: {keyword: this.keyword_from}}).then(response => {
                        this.currencies = response.data.data;
                        this.total = response.data.total
                        this.from = response.data.from
                        this.to = response.data.to
                    });
                });
            },
            findToCurrencies() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.get('/api/v1/currencies/search/to', {params: {keyword: this.keyword_to}}).then(response => {
                        this.currencies = response.data.data;
                        this.total = response.data.total
                        this.from = response.data.from
                        this.to = response.data.to
                    });
                });
            },
            makePagination(response) {
                let pagination = {
                    current_page: response.data.current_page,
                    first_page: response.data.first_page_url,
                    last_page: response.data.last_page_url,
                    next_page: response.data.next_page_url,
                    prev_page: response.data.prev_page_url
                }
                this.pagination = pagination;
            },
            getPage(url) {
                this.url = url;
                this.getCurrencies();
            }
        }
    }
</script>

<style>
    .table {
        table-layout: fixed;
    }
</style>