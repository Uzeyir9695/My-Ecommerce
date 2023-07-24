<template>
    <div class="d-flex flex-column flex-sm-row pt-1">
        <a href="javascript:void(0)" @click="addToCart(product)" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0">
            <font-awesome-icon icon="cart-shopping" class="mr-50"/>
            <span  class="add-to-cart">{{ isProductInCart(product.id)? 'Added' : 'Add to cart' }}</span>
        </a>
        <a href="javascript:void(0)" @click="addToWishlist(product.id)" class="btn btn-light mr-0 mr-sm-1 mb-1 mb-sm-0">
            <font-awesome-icon icon="heart" class="mr-50" :class="{ 'text-danger': isProductInWishlist(product.id), 'text-muted': !isProductInWishlist(product.id) }"/>
            <span>Wishlist</span>
        </a>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    props: ['product'],
    data() {
        return {
            wishlistId: null,
        }
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

    methods: {
        async addToCart(product) {
            if (this.isProductInCart(product.id)) {
                return; // Exit the method if the product is already added
            }

            const item = {
                product_id: product.id,
                price: this.price(product.price, product.discount),
                discount: product.discount
            }
            await this.$store.dispatch('cart/addToCart', item);
        },

        async addToWishlist(product_id) {
            const isProductInWishlist = this.isProductInWishlist(product_id);
            if (isProductInWishlist) {
                // Remove the product from the wishlist
                await this.$store.dispatch('wishlist/removeFromWishlist', product_id);
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
