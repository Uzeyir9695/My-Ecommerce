<template>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-6 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <router-link :to="{name: 'stores.index'}" class="btn btn-primary mr-1">Stores</router-link>
                        <router-link :to="{name: 'products.create', query: { store_id: store.id}}" class="btn btn-primary">Add product</router-link>
                    </div>
                </div>
            </div>
            <div class="content-body" v-if="store.id !== undefined">
                <div id="user-profile">
                    <!-- profile header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-header mb-2">
                                <!-- profile cover photo -->
                                <img class="card-img-top" :src="store.media[0].original_url" style="max-width: 100%;height: 400px; object-fit:cover;" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <div class="profile-img">
                                            <img :src="store.media[1].original_url" class="rounded img-fluid" alt="Card image" />
                                        </div>
                                        <!-- profile title -->
                                        <div class="profile-title ml-3">
                                            <h2 class="text-white">{{ store.name }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                        <button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                        </button>

                                        <!-- collapse  -->
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                                <ul class="nav nav-pills mb-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold active" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">Main</span>
                                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- edit button -->

                                                <div>
                                                    <router-link :to="{name: 'stores.edit', params: { id: store.id}}" class="btn btn-primary mr-1"><i class="fa-regular fa-pen-to-square"></i>Edit</router-link>
                                                    <a type="button" data-toggle="modal" data-target="#delete" class=" btn btn-danger delete"><i data-feather="trash"></i>Delete</a>
                                                    <div class="modal fade text-start" id="delete" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel33">Are you sure?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                                </div>
                                                                <form>
                                                                    <div class="modal-body">
                                                                        <label>Due to delete, enter a word - <strong>"Delete"</strong> in capital case.</label>
                                                                        <div class="mt-1">
                                                                            <input autocomplete="off" v-model="word" type="text" placeholder="Enter the word..." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button @click.prevent="destroyShop(store.id)" class="btn btn-warning waves-effect waves-float waves-light">OK</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ collapse  -->
                                    </nav>
                                    <!--/ navbar -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ profile header -->

                    <!-- profile info section -->
                    <section id="profile-info">
                        <div class="row">
                            <!-- left profile info section -->
                            <div class="col-lg-3 col-12">
                                <!-- about -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">About</h5>
                                        <p class="card-text">{{ store.description }}</p>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Created:</h5>
                                            <p class="card-text">{{ store.created_at }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Location:</h5>
                                            <p class="card-text ml-1"><strong>Country: </strong> {{ store.country }}</p>
                                            <p class="card-text ml-1"><strong>City: </strong> {{ store.city }}</p>
                                            <p class="card-text ml-1"><strong>Street: </strong> {{ store.street }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Email:</h5>
                                            <p class="card-text">{{ store.email }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Phone:</h5>
                                            <p class="card-text">{{ store.phone }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0"><a href="{{ store.website }}">View Website</a></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- suggestion pages -->

                                <!--/ suggestion pages -->
                            </div>
                            <div class="col-lg-9" v-if="products && products.length > 0">
                                <div class="row">
                                    <div class="col-lg-4" v-for="product in products">
                                        <div class="card ecommerce-card">
                                            <div class="item-img text-center">
                                                <a href="javascript:void(0);">
                                                    <img class="img-fluid card-img-top" :src="product.media[0].original_url" style="width: 350px; height: 250px;" alt="img-placeholder" />
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="item-wrapper">
                                                    <div class="item-rating">
                                                        <ul class="unstyled-list list-inline">
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="item-name">
                                                    <router-link class="text-body" :to="{ name: 'products.show', params: {id: product.id} }">
                                                        {{ product.name }}
                                                    </router-link>
                                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                                </h6>
                                                <p class="card-text item-description">{{ product.description.slice(0, 35) }}
                                                </p>
                                            </div>
                                            <div class="item-options text-center">
                                                <router-link class="text-black btn btn-light col-6 float-left" :to="{ name: 'products.show', params: {id: product.id} }">
                                                    <i class="fa-solid fa-eye"></i>View
                                                </router-link>

                                                <router-link class="text-white btn btn-primary col-6 float-right" :to="{ name: 'products.edit', params: {id: product.id} }">
                                                    <i class="fa-regular fa-pen-to-square"></i>Edit
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="products.length < 1">
                                        <h3 class="mx-auto mt-3">Product(s) not found for this store!</h3>
                                        <div class="w-100"></div>
                                        <router-link :to="{name: 'products.create', query: { store_id: store.id}}" class="btn btn-info mx-auto mb-3">Add now</router-link>
                                    </div>
                                </div>
                                <!-- reload button -->
                                <div class="row d-flex justify-content-center">
                                </div>
                                <!--/ reload button -->
                            </div>
                        </div>

                    </section>
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

</template>
<script>

import baseApi from '@/auth/api'
import router from '@/router';
export default {
    data(){
        return {
            products: {},
            store: {},
            word: ''
        }
    },

    created(){
        this.fetchProducts();
        this.fetchStore();
    },


    methods:{
        async fetchProducts(){
            await baseApi.get('/api/products')
            .then(({data})=> {
                this.products = data.products.data
            })
            .catch(({errors})=> {
                console.log(errors)
            })
        },

        async fetchStore(){
            await baseApi.get('/api/stores/'+this.$route.params.id)
                .then(({data})=> {
                    this.store = data.store
                })
                .catch(({errors})=> {
                    console.log(errors)
                })
        },

        async destroyShop(id){
            if(this.word === 'Delete'){
                await baseApi.delete('/api/stores/'+id)
                    .then((response)=> {
                        router.push({name: 'stores.index'})
                    })
                    .catch((error)=> {
                        console.log(error)
                    })
            } else {
                router.push({name: 'stores.show', params: {id: id}})
            }
        }

    }
}
</script>
