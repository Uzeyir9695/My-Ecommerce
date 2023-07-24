<template>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <img src="/app-assets/images/logo/favicon.ico" alt="logo">
                                    <h2 class="brand-text text-primary ml-1">E-commerce</h2>
                                </a>
                                <form class="auth-login-form mt-2">
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="login-email" name="email" v-model="credintials.email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus />
                                        <small class="text-danger" v-if="errors && errors.email"><strong>{{ errors.email[0] }}</strong></small>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Password</label>
                                            <a href="">
                                                <small class="font-weight-bold">Forgot Password?</small>
                                            </a>
                                        </div>
                                        <div class="input-group">
                                            <input type="password" class="form-control rounded-top rounded-bottom" v-model="credintials.password" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                                        </div>
                                        <small class="text-danger" v-if="errors && errors.password"><strong>{{ errors.password[0] }}</strong></small>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="remember-me" tabindex="3" />
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>

                                    <button type="submit" @click.prevent="login" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                                </form>


                                <p class="text-center mt-2">
                                    <span>New on our platform?</span>
                                    <a href="">
                                        <span class="font-weight-bold">Create an account</span>
                                    </a>
                                </p>

                                <div class="divider my-2">
                                    <div class="divider-text">or</div>
                                </div>

                                <div class="auth-footer-btn d-flex justify-content-center">
                                    <a :href="socialFBRoute">
                                        <i class="fa-brands fa-facebook" style="font-size: 25px;"></i>
                                    </a>
                                    <a :href="socialGORoute">
                                    <i class="fa-brands fa-google-plus" style="font-size: 25px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import router from '@/router';

export default {
    name:"login",
    data(){
        return {
            credintials:{
                email:"",
                password:""
            },
            errors: null,
            socialFBRoute: import.meta.env.VITE_APP_URL+'/auth/facebook/redirect',
            socialGORoute: import.meta.env.VITE_APP_URL+'/auth/google/redirect'
        }
    },

    computed: {
        ...mapGetters({
            processing: 'auth/processing',
            authenticated: 'auth/authenticated',
        }),
    },

    created(){
    },

    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),

       async login(){
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/login', this.credintials)
                .then(({data})=>{
                    this.signIn(data)
                    router.push({ name: 'all-products' });
                })
                .catch((errors) => {
                    if (errors.response.status === 422) {
                        this.errors = errors.response.data.errors
                    }
                });
        },
    }
}
</script>
