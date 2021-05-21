<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-6 offset-3">
              <div class="card">
                <div class="card-header">
                  <h4>Register</h4>
                </div>
                <div class="card-body">
                  <form action="#" @submit.prevent="handleRegister">
                    <div class="form-row">
                      <input type="text" name="name" id="name" v-model="formData.name" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-row">
                      <input type="email" name="email" id="email" v-model="formData.email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-row">
                      <input type="password" name="password" id="password" v-model="formData.password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-row">
                      <input type="password" name="password_confirmation" id="password-confirmation" v-model="formData.password_confirm" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="form-row justify-content-end">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </form>
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
                url: '/api/v1/auth/register',
                formData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirm: ''
                }
            }
        },
        methods: {
          handleRegister() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(this.url, this.formData).then(response => {
                  if (response.status === 201) {
                      this.$router.push(this.$route.query.redirect || '/login')
                  }
                });
            });
          },
        }
    }
</script>

<style>
    .form-row {
        margin-bottom: 8px;
    }
</style>