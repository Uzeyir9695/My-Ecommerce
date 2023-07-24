<template>

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
            signUp:'auth/register'
        }),

        async register(){
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/login', this.credintials)
                .then(({data})=>{
                    this.signUo(data)
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
