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
            </div>
            <div class="content-body">
                <div class="row empty-wishlist d-flex justify-content-center">
                    <div :class="{'d-none': !isWishlistEmpty}">
                        <img class="rounded d-block mx-auto ml-sm-0" src="/cart-media/wishlist.png" alt="donuts">
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
                                <font-awesome-icon icon="cart-shopping" />
                                <span v-if="!isProductInCart(wishlist.product.id)" class="add-to-cart">Move to cart</span>
                                <span v-show="isProductInCart(wishlist.product.id)" class="add-to-cart">Already added</span>
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
import { mapState, mapGetters } from 'vuex'

export default {
    props: ['productShowRoute'],

    data() {
        return {
            routes: {
                productShowRoute: this.productShowRoute,
            },
            isWishlistEmpty: false
        }
    },

    created() {
        this.$store.dispatch('wishlist/fetchWishlist');
    },

    updated(){
        if (this.wishlists.length < 1) {
            this.isWishlistEmpty = true
        }
    },
    computed: {
        ...mapGetters({
            wishlists: 'wishlist/wishlists',
            paginateWishlist: 'wishlist/paginateWishlist',
        }),

        ...mapState('cart', ['cartItems']),
        isProductInCart() {
            return function(productId) {
                return this.cartItems.some(cart => cart.product_id === productId); // Check if a product already exists in cart to avoid duplication
            }
        }
    },

    methods: {
        async paginate(page) {
            // Call your Vuex action to fetch data for the specified page
            await this.$store.dispatch('wishlist/fetchWishlist', page);
        },

        moveToCart(product){
            if (this.isProductInCart(product.id)) {
                return; // Exit the method if the product is already added
            }

            const item = {
                product_id: product.id,
                price: this.price(product.price, product.discount),
                discount: product.discount
            }
            this.$store.dispatch('cart/addToCart', item);
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
