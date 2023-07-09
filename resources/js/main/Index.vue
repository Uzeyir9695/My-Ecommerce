<template>
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-detached content-center overlay">
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                        </button>
                                        <div class="search-results">{{ products.total }} results found</div>
                                    </div>
                                    <div class="view-options d-flex">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option1" checked />
                                                <i data-feather="grid" class="font-medium-3"></i>
                                            </label>
                                            <label class="btn btn-icon btn-outline-primary view-btn list-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option2" />
                                                <i data-feather="list" class="font-medium-3"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Content Section Starts -->

                    <!-- Spinner loading  starts-->
                    <div v-if="contentLoading" class="d-flex align-items-center loading">
                        <span class="spinner-border text-primary mr-1"></span>
                        <span>Loading...</span>
                    </div>
                    <!-- Spinner loading  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product" v-model="searchProduct" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Search Bar Ends -->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view" v-if="products && products.total > 0">
                        <div class="card ecommerce-card" v-for="product in products.data">
                            <div class="item-img text-center">
                                <a :href="routes.productShow+'/'+product.id">
                                    <img class="img-fluid card-img-top" :src="product.media[0].original_url" style="width: 450px; height: 290px;"  alt="img-placeholder" /></a>
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
                                    <div class="d-flex justify-content-center">
                                        <h6 v-if="product.discount>0"><del><span class="wishlist-price mr-1 text-danger">{{ product.price }} USD</span></del> </h6>
                                        <h6 class="item-price">{{ price(product.price, product.discount) }} USD</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" :href="routes.productShow+'/'+product.id">{{ product.name }}</a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">E-Commerce</a></span>
                                </h6>
                                <p class="card-text item-description">{{ product.description }}</p>
                            </div>
                            <div class="item-options">
                                <a href="javascript:void(0)" @click="addToWishlist(product.id)" class="btn btn-light btn-wishlist">
                                    <font-awesome-icon icon="heart"  :class="{ 'text-danger': isProductInWishlist(product.id), 'text-muted': !isProductInWishlist(product.id) }"/>
                                    <span>Wishlist</span>
                                </a>
                                <a :href="isProductInCart(product.id) ? this.routes.productShow+'/'+product.id: '#'" :ref="'pathToProduct-'+product.id" @click="addToCart(product)" class="btn btn-primary btn-cart">
                                    <font-awesome-icon icon="cart-shopping" />
                                    <span  class="add-to-cart">{{ isProductInCart(product.id)? 'View' : 'Add to cart' }}</span>
                                </a>
                            </div>
                        </div>

                    </section>
                    <!-- E-commerce Products Ends -->
                    <!--  display if product not found-->
                    <div class="row col-12"  v-if="!products && products.total < 1">
                        <h3 class="float-right mt-3 text-danger">Product not found!</h3>
                    </div>
                    <!-- E-commerce Pagination Products -->
                    <section id="ecommerce-pagination" v-if="products && products.total > 21">
                        <div class="row d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" :class="{ 'disabled': products.current_page === 1 }">
                                        <a class="page-link" href="#" @click.prevent="paginate(products.current_page - 1)" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item" :class="{ 'active': page === products.current_page }" v-for="page in products.last_page" :key="page">
                                        <a class="page-link" href="#" @click.prevent="fetchProducts(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ 'disabled': products.current_page === products.last_page }">
                                        <a class="page-link" href="#" @click.prevent="paginate(products.current_page + 1)" aria-label="Next">
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
    </div>
    <!-- END: Content-->
</template>



<script>
import { mapGetters } from 'vuex'
export default {
    props: {
        productShowRoute: {
            type: String
        },
        addWishlistRoute: {
            type: String
        },
        productsIndexRoute: {
            type: String
        },
    },
    data() {
        return {
            routes: {
                productShow: this.productShowRoute,
                wishlistCreate: this.addWishlistRoute,
                productsIndex: this.productsIndexRoute,
            },
            cartLink: '#',
            products: [],
            wishlistid: null,
            searchProduct: '',
            contentLoading: false
        }
    },

    created() {
        this.fetchProducts();
    },


    computed: {
        ...mapGetters({
            wishlist: 'wishlist/wishlists',
            cartItems: 'cart/cartItems',
        }),

        isProductInCart() {
            return function(productId) {
                return this.cartItems.some(cart => cart.product_id === productId); // Check if a product already exists in cart to avoid duplication
            }
        },

        isProductInWishlist() {
            return function(productId) {
                return this.wishlist.some(wishlist => wishlist.product_id === productId); // Check if a product already exists in wishlist to avoid duplication
            }
        }
    },

    watch: {
        async searchProduct(newQuery) {
            await this.fetchProducts(1, newQuery); // Fetch products with the updated search query
        }
    },

    methods: {
        async fetchProducts(page, searchQuery){
            this.contentLoading = true;
            await axios.get('/all-products', {
                params: {
                    page: page,
                    search: searchQuery
                }
            })
            .then((response) => {
                this.products = response.data.products;
                this.contentLoading = false;
            })
             .catch((error) => {
                 this.contentLoading = false;
                 console.log(error.response.data.errors)
             })
        },

        async addToCart(product) {
            if (this.isProductInCart(product.id)) {
                return; // Exit the method if the product is already added
            }

            const item = {
                product_id: product.id,
                price: this.price(product.price, product.discount),
                discount: product.discount
            }
           await this.$store.dispatch('cart/addToCart', item)
                .then(response => {
                    const refElement = this.$refs['pathToProduct-' + product.id]; // Access the ref element and manipulate it
                    refElement[0].href = this.routes.productShow+'/'+product.id; // Modify the href attribute of the anchor element
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async addToWishlist(product_id) {
            const isProductInWishlist = this.isProductInWishlist(product_id);
            if (isProductInWishlist) {
                // Remove the product from the wishlist
                await this.$store.dispatch('wishlist/removeFromWishlist', this.wishlistId);
                this.$store.dispatch('wishlist/fetchWishlist'); // Refetch wishlist from DB after removing from wishlist
            } else {
                // Add the product to the wishlist
                await this.$store.dispatch('wishlist/addToWishlist', product_id)
                    .then ((response) => {
                        this.wishlistId = response.data.wishlist_id;
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors)
                    })
                this.$store.dispatch('wishlist/fetchWishlist'); // Refetch wishlist from DB after adding to wishlist
            }
        },
        // calculate product's discount
        price(price, discount=0){
            return price - (price*discount/100);
        },
    }
}
</script>
<style scoped>
.loading {
    position: fixed;
    top: 12.5%;
    left: 54%;
    z-index: 1;
}
.spinner-border {
    height: 30px;
    width: 30px;
}
@media (max-width: 768px) {
    /* Adjust for mobile phone size */
    .loading {
        left: 35%;
    }
}
</style>
