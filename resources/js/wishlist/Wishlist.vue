<template>
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">WishList</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row empty-wishlist d-none" v-if="wishlists.length === 0">
<!--                     Here goes default mepty wishlist image -->
                    <div class="col-8 offset-2 ">
                        <img class="rounded d-block mx-auto" src="/cart-media/wishlist.png" alt="donuts">
                        <div class="text-center"><h1 class="mt-2">Your Wishlist Is Empty</h1></div>
                    </div>
                </div>
                <!-- Wishlist Starts -->
                <section id="wishlist" class="grid-view wishlist-items">
                    <div class="card ecommerce-card wishlist-remove" v-for="wishlist in wishlists" :key="wishlist.id">
                        <div class="item-img text-center">
                            <a :href="productShowRoute+'/'+wishlist.product.id">
                                <img :src="wishlist.product.media[0].original_url" class="img-fluid" style="width: 350px; height: 250px;"  alt="img-placeholder" />
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
                                <div class="item-cost d-flex justify-content-center">
                                    <h6 v-if="wishlist.product.discount > 0"><del>$<span class="wishlist-price mr-1">{{ wishlist.product.price }}</span></del> </h6>
                                    <h6>$<span class="wishlist-price">{{ price(wishlist.product.price, wishlist.product.discount) }}</span> </h6>
                                </div>
                            </div>
                            <div class="item-name">
                                <a :href="productShowRoute+'/'+wishlist.product.id">{{ wishlist.product.name }}</a>
                            </div>
                            <p class="card-text item-description">{{ wishlist.product.description }}</p>
                        </div>
                        <div class="item-options text-center">
                            <button @click="removeFromWishlist(wishlist.id)" type="button" class="btn btn-light btn-wishlist remove-wishlist">
                                <font-awesome-icon icon="trash" />
                                <span>Remove</span>
                            </button>
                            <button @click="moveToCart(wishlist.product)" type="button" class="btn btn-primary btn-cart move-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Move to cart</span>
                            </button>
                        </div>
                    </div>
                </section>
                <!-- E-commerce Pagination Products -->
                <section id="ecommerce-pagination"  v-if="paginateWishlist && paginateWishlist.total > 21">
                    <div class="row d-flex justify-content-center">
                        <nav >
                            <ul class="pagination">
                                <li class="page-item" :class="{ 'disabled': paginateWishlist.current_page === 1 }">
                                    <a class="page-link" href="#" @click.prevent="paginate(paginateWishlist.current_page - 1)" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item" :class="{ 'active': page === paginateWishlist.current_page }" v-for="page in paginateWishlist.last_page" :key="page">
                                    <a class="page-link" href="#" @click.prevent="paginate(page)">{{ page }} </a>
                                </li>
                                <li class="page-item" :class="{ 'disabled': paginateWishlist.current_page === paginateWishlist.last_page }">
                                    <a class="page-link" href="#" @click.prevent="paginate(paginateWishlist.current_page + 1)" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </section>
                <!-- E-commerce Pagination Ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    props: ['productShowRoute'],

    data() {
        return {
            routes: {
                productShowRoute: this.productShowRoute,
            },
        }
    },

    created() {
    },

    computed: {
        ...mapGetters({
            wishlists: 'wishlist/wishlists',
            paginateWishlist: 'wishlist/paginateWishlist',
        }),
    },

    methods: {
        async paginate(page) {
            // Call your Vuex action to fetch data for the specified page
            await this.$store.dispatch('wishlist/fetchWishlist', page);
        },

        moveToCart(product){
            const item = {
                product_id: product.id,
                price: this.price(product.price, product.discount),
                discount: product.discount
            }
            this.$store.dispatch('cart/addToCart', item)
                .then((response) => {
                    toastr['success']('', 'Moved Item To Your Cart 🛒', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        },

        removeFromWishlist(id){
            this.$store.dispatch('wishlist/removeFromWishlist', id);
        },

        // calculate product's discount
        price(price, discount=0){
            return price - (price*discount/100);
        },
    }
}
</script>
<style>
</style>