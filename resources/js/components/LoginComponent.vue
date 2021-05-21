<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Sign in</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="handleLogin">
                            <div class="form-row">
                                <input required type="email" name="email" id="email" v-model="formData.email" :class="`${unauthorized.class} form-control`" placeholder="Email Address">
                            </div>
                            <div class="form-row">
                                <input required type="password" name="password" id="password" v-model="formData.password" :class="`${unauthorized.class} form-control`" placeholder="Password">
                            </div>
                            <div class="form-row" v-if="unauthorized.message">
                                <small class="text-danger">{{ unauthorized.message }}</small>
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
                unauthorized: {},
                url: '/api/v1/auth/login',
                formData: {
                    email: '',
                    password: '',
                }
            }
        },
        methods: {
            handleLogin() {
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.post(this.url, this.formData).then(response => {
                        if (response.status === 200)
                            this.$router.push(this.$route.query.redirect || '/');
                    })
                    .catch(error => {
                        switch (error.response.status) {
                            case 401:
                                this.unauthorized = {
                                    class: 'border-danger',
                                    message: 'password or email is incorrect'
                                };                               
                                break;
                            case 500:
                                alert('MESSAGE: Internal server error');
                                break;
                        }

                    });
                });
            },
        },
    }
</script>

<style>
    .form-row {
        margin-bottom: 8px;
    }
</style>