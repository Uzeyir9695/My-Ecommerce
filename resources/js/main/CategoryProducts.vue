<template>
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Breadcrumb | Shop</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached content-right">
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <div class="search-results"  v-if="products && products.length > 0">{{ products.length }} results found</div>
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

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" :class="{ 'products-opacity': contentLoading }" class="grid-view" v-if="products && products.length > 0">
                        <div class="card ecommerce-card" v-for="product in products">
                            <div class="item-img text-center">
                                <router-link :to="{ name: 'products.show', params: {id: product.id}}">
                                    <img class="img-fluid card-img-top" :src="product.media[0].original_url" style="width: 500px; height: 250px;"  alt="img-placeholder" />
                                </router-link>
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
                                    <router-link :to="{ name: 'products.show', params: {id: product.id}}"> {{ product.name }}</router-link>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">E-Commerce</a></span>
                                </h6>
                                <p class="card-text item-description">{{ product.description }}</p>
                            </div>
                            <div class="item-options">
                                <a href="javascript:void(0)" @click="addToWishlist(product.id)" class="btn btn-light btn-wishlist">
                                    <font-awesome-icon icon="heart"  :class="{ 'text-danger': isProductInWishlist(product.id), 'text-muted': !isProductInWishlist(product.id) }"/>
                                    <span>Wishlist</span>
                                </a>
                                <a href="javascript:void(0)" :ref="'pathToProduct-'+product.id" @click="addToCart(product)" class="btn btn-primary btn-cart">
                                    <font-awesome-icon icon="cart-shopping" />
                                    <span  class="add-to-cart">{{ isProductInCart(product.id)? 'Added' : 'Add to cart' }}</span>
                                </a>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Products Ends -->
                    <!--  display if product not found-->
                    <div :class="{'d-none': isProduct}">
                        <div class="d-flex justify-content-center">
                            <div class="text-center">
                                <h1 class="mt-2">Product not found!</h1>
                            </div>
                        </div>
                    </div>

                    <!-- E-commerce Pagination Products -->
                    <section id="ecommerce-pagination" v-if="paginateProducts && paginateProducts.total > 21">
                        <div class="row d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" :class="{ 'disabled': paginateProducts.current_page === 1 }">
                                        <a class="page-link" href="javascript:void(0)" @click.prevent="paginate(paginateProducts.current_page - 1)" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item" :class="{ 'active': page === paginateProducts.current_page }" v-for="page in paginateProducts.last_page" :key="page">
                                        <a class="page-link" href="javascript:void(0)" @click.prevent="paginate(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ 'disabled': paginateProducts.current_page === paginateProducts.last_page }">
                                        <a class="page-link" href="javascript:void(0)" @click.prevent="paginate(paginateProducts.current_page + 1)" aria-label="Next">
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
            <div class="sidebar-detached sidebar-left">
                <div class="sidebar">
                    <!-- Ecommerce Sidebar Starts -->
                    <div class="sidebar-shop">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Price Filter starts -->
                                <div class="brands" v-for="(values, name) in attributes" >
                                    <h4 class="filter-title mt-2 text-primary">{{ name }}</h4>
                                    <ul class="list-unstyled brand-list">
                                        <li v-for="value in values">
                                            <form action="" method="post">
                                                <div class="custom-control custom-checkbox ">
                                                    <input type="checkbox" class="custom-control-input  attribute-checkbox" :id="`washer-${value.id}`"
                                                           :name="name"
                                                           :value="value.value"
                                                           :checked="isSelected(name, value.value)"
                                                           @change="handleCheckboxChange(name, value.value)"
                                                    >
                                                    <label class="custom-control-label" :for="`washer-${value.id}`">{{ value.value }}</label>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Price Filter ends -->

                                <!-- Rating starts -->
                                <div id="ratings">
                                    <h6 class="filter-title">Ratings</h6>
                                    <div class="ratings-list">
                                        <a href="javascript:void(0)">
                                            <ul class="unstyled-list list-inline">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li>& up</li>
                                            </ul>
                                        </a>
                                        <div class="stars-received">160</div>
                                    </div>
                                    <div class="ratings-list">
                                        <a href="javascript:void(0)">
                                            <ul class="unstyled-list list-inline">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li>& up</li>
                                            </ul>
                                        </a>
                                        <div class="stars-received">176</div>
                                    </div>
                                    <div class="ratings-list">
                                        <a href="javascript:void(0)">
                                            <ul class="unstyled-list list-inline">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li>& up</li>
                                            </ul>
                                        </a>
                                        <div class="stars-received">291</div>
                                    </div>
                                    <div class="ratings-list">
                                        <a href="javascript:void(0)">
                                            <ul class="unstyled-list list-inline">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                <li>& up</li>
                                            </ul>
                                        </a>
                                        <div class="stars-received">190</div>
                                    </div>
                                </div>
                                <!-- Rating ends -->

                                <!-- Clear Filters Starts -->
                                <div id="clear-filters">
                                    <button @click="clearFilters" type="button" class="btn btn-block btn-primary">Clear All Filters</button>
                                </div>
                                <!-- Clear Filters Ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Ecommerce Sidebar Ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
</template>



<script>
import { mapGetters } from 'vuex';
export default {
    props: {
        subCatRoute: {
            type: String
        },
        productShowRoute: {
            type: String
        },
        addWishlistRoute: {
            type: String
        },
    },
    data() {
        return {
            cartLink: '#',
            selectedFilters: {},
        }
    },
    watch: {
        $route(to, from) {
            // Check if the route parameters have changed
            if (to.params.id !== from.params.id) {
                // Call the action or method to update the content
                this.$store.dispatch('product/fetchProducts', this.$route.fullPath);
            }
        },
    },

    created() {
        this.$store.dispatch('product/fetchProducts', this.$route.fullPath);
    },

    computed: {
        ...mapGetters({
            products: 'product/products',
            contentLoading: 'product/contentLoading',
            isProduct: 'product/isProduct',
            attributes: 'product/attributes',
            paginateProducts: 'product/paginateProducts',
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

    methods: {
        handleCheckboxChange(attributeName, attributeValue) {
            if (!this.selectedFilters.hasOwnProperty(attributeName)) {
                this.selectedFilters[attributeName] = [];
            }
            const attributeFilters = this.selectedFilters[attributeName];
            const index = attributeFilters.indexOf(attributeValue);
            if (index > -1) {
                attributeFilters.splice(index, 1);
            } else {
                attributeFilters.push(attributeValue);
            }

            // Update the selectedFilters object
            this.updateSelectedFilters();

            // Send AJAX request or perform any necessary operations with the selected filters
            const payload = { paginateRoute: this.$route.fullPath, filters: this.selectedFilters };
            this.$store.dispatch('product/fetchProducts', payload);
        },

        updateSelectedFilters() {
            // Create a new object to store the updated selected filters
            const updatedSelectedFilters = {};
            // Loop through the selectedFilters object and remove unchecked attribute names and their values
            for (const attributeName in this.selectedFilters) {
                const attributeValues = this.selectedFilters[attributeName];
                if (attributeValues.length > 0) {
                    updatedSelectedFilters[attributeName] = attributeValues;
                }
            }
            // Assign the updated object to selectedFilters
            this.selectedFilters = updatedSelectedFilters;
        },

        isSelected(attributeName, attributeValue) {
            return (
                this.selectedFilters.hasOwnProperty(attributeName) &&
                this.selectedFilters[attributeName].includes(attributeValue)
            );
        },

        clearFilters() {
            // Clear the selectedFilters object and localStorage
            for (const attributeName in this.selectedFilters) {
                for (const attributeValue of this.selectedFilters[attributeName]) {
                    const key = `${attributeName}_${attributeValue}`;
                    localStorage.removeItem(key);
                }
            }
            this.selectedFilters = {};

            // Send AJAX request or perform any necessary operations to clear the filters
            const payload = { paginateRoute: this.$route.fullPath, filters: this.selectedFilters };
            this.$store.dispatch('product/fetchProducts', payload);
        },

        async paginate(page) {
            // Call your Vuex action to fetch data for the specified page
            await this.$store.dispatch('product/fetchProducts', this.$route.fullPath+'?page='+page);
        },

        addToCart(product) {
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

        async addToWishlist(product_id) {
            const isProductInWishlist = this.isProductInWishlist(product_id);
            if (isProductInWishlist) {
                // Remove the product from the wishlist
                await this.$store.dispatch('wishlist/removeFromWishlist', product_id);
                this.$store.dispatch('wishlist/fetchWishlist'); // Refetch wishlist from DB after removing from wishlist
            } else {
                // Add the product to the wishlist
                await this.$store.dispatch('wishlist/addToWishlist', product_id);
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
.products-opacity {
    opacity: 0.1;
}
.loading {
    position: fixed;
    display: flex;
    top: 50%;
    left: 61%;
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
