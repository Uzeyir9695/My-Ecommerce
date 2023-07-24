<template>
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <div class="bookmark-input search-input">
                            <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                            <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                            <ul class="search-list search-list-bookmark"></ul>
                        </div>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ml-auto">
                    <cart-list></cart-list>
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ user.name }}</span><span class="user-status">Customer</span></div><span class="avatar"><img class="round" src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                            <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="user"></i> Profile</router-link>
                            <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="shopping-cart"></i>My Stores</router-link>
                            <a @click.prevent="myProducts" class="dropdown-item"><i class="mr-50" data-feather="box"></i> My Products</a>
                            <router-link :to="{name: 'my-orders'}" class="dropdown-item"><i class="mr-50" data-feather="shopping-bag"></i> My Orders</router-link>
                            <div class="dropdown-divider"></div>
                            <router-link :to="{name: 'stores.index'}" class="dropdown-item"><i class="mr-50" data-feather="settings"></i> Settings</router-link>

                            <a class="dropdown-item" href="#" @click.prevent="logout">
                                <i class="mr-50" data-feather="power"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="/html/ltr/vertical-menu-template-semi-dark/index.html">
                        <img src="/app-assets/images/logo/favicon.ico" alt="logo">
                        <h2 class="brand-text">Ecommerce</h2>
                    </a></li>
                    <li class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                            <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Categories</span><i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item mb-2" :class="this.$route.name === 'all-products' ? 'active' : ''">
                        <router-link :to="{ name: 'all-products' }">
                            <i data-feather="grid"></i>
                            <span class="menu-title text-truncate" data-i18n="Kanban">All Categories</span>
                        </router-link>

                    </li>
                    <li class="nav-item" v-for="category in categories">
                        <a class="d-flex align-items-center" href="#">
                            <img :src="'/'+category.icon" alt="" style="width: 25px; height: 25px; background-color: floralwhite; padding: 3px; border-radius: 50px; " class="mr-1">
                            <span class="menu-title text-truncate">{{ category.name }}</span>
                        </a>
                        <ul class="menu-content">
                            <li :class="this.$route.params.id === subcategory.id ? 'active' : ''"  v-for="subcategory in category.subcategories">
                                <router-link :to="{name: 'subcategory.products', params: { id: subcategory.id, slug: subcategory.slug }}">
                                    <img :src="'/'+subcategory.icon" alt="" style="width: 28px; height: 28px; border-radius: 50px; padding: 3px; background-color: floralwhite" class="mr-1">
                                    <span class="menu-item text-truncate">{{ subcategory.name }}</span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Main Menu-->
    <router-view />

<!--       <router-view name="login"></router-view>-->
</template>

<script>

import { mapActions, mapGetters } from 'vuex'
import axios from 'axios'
import CartList from './cart/CartList.vue'
export default {
    components: {
        CartList,
    },

    data(){
        return {
            categories: null
        }
    },

    computed: {
        ...mapGetters({
            processing: 'auth/processing',
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),
    },

    created(){
        // this.authenticated = false
        // localStorage.clear('token')
        this.fetchCategories();
    },


    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),

        async logout(){
                await this.signOut();
                this.$router.push({name:"login"});
        },

        async fetchCategories(){
            await axios.get('/api/dashboard')
                .then((response) => {
                    this.categories = response.data.categories
                }).catch((error) => {
                    console.log(error)
                })
        },

        myProducts(){
            if(this.authenticated){
                this.$router.push({name: "products.index"})
            } else {

                Swal.fire({
                    title: 'Oops!',
                    text: 'Sign in to continue',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 5000,
                });
            }
        }
    }
}
</script>

