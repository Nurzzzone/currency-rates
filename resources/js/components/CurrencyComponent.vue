<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover m-0">
                      <thead>
                        <tr>
                            <th class="font-small-2 border-bottom-0 border-top-0">From</th>
                            <th class="font-small-2 border-bottom-0 border-top-0">To</th>
                            <th class="font-small-2 border-bottom-0 border-top-0">Exchange Rate (amount: 1)</th>
                            <th class="font-small-2 border-bottom-0 border-top-0">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(currency, index) in currency" :key="index">
                          <td v-text="currency.from"></td>
                          <td v-text="currency.to"></td>
                          <td v-text="currency.rate"></td>
                          <td v-text="currency.date"></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
      data() {
          return {
              url: '/api/v1/currencies/history/' + this.$route.params.id,
              currency: [],
          }
      },
      mounted() {
          this.getCurrencies();
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
                              this.currency = response.data;
                          }
                      })
                      .catch(error => console.log(error));
              });
          },
      }
  }
</script>

<style>
    .table {
        table-layout: fixed;
    }
</style>