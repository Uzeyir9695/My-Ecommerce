<template>
   <div>
       <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span v-if="carts.length > 0" class="badge badge-pill badge-primary badge-up cart-item-count">{{ carts.length }}</span></a>
           <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
               <li class="dropdown-menu-header">
                   <div class="dropdown-header d-flex">
                       <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                       <div class="badge badge-pill badge-light-primary">{{ carts.length }} Items</div>
                   </div>
               </li>
               <li class="scrollable-container media-list">
                   <div class="media align-items-center" v-for="cart in carts" :key="cart.id">
                           <img class="d-block rounded mr-1" :src="cart.product.media[0].original_url" alt="donuts" width="62">
                           <div class="media-body" >
                               <span class="remove-cart" @click="removeFromCart(cart.id)"><font-awesome-icon icon="trash" /></span>
                               <div class="media-heading">
                                   <h6 class="cart-item-title"><a class="text-body" :href="productShowRoute+'/'+cart.product.id"> {{ cart.product.name }}</a></h6><small class="cart-item-by">By E-commerce</small>
                               </div>
                               <h5 class="cart-item-price">${{ cart.price }}</h5>
                           </div>
                   </div>
               </li>
            <!--    Show if cart is emtpy   -->
               <li class="scrollable-container media-list cart-media-list" v-if="carts.length < 1">
                   <div class="row mb-2 default-cart-content">
                       <div class="col-12 text-center">
                           <img class=" rounded mr-1 d-block mx-auto" src="/cart-media/cart-is-empty.gif" alt="donuts" width="320px" height="230px">
                       </div>
                       <div class="col-12 text-center">
                           <div class="mx-auto"><h5 class="mt-2 text-danger mx-auto">Your Shopping Cart is empty</h5></div>
                       </div>
                   </div>
               </li>

               <li class="dropdown-menu-footer">
                   <div class="d-flex justify-content-between mb-1">
                       <h6 class="font-weight-bolder mb-0">Total:</h6>
                       <h6 class="text-primary font-weight-bolder mb-0">${{ totalPrice }}</h6>
                   </div><a v-if="carts.length > 0" class="btn btn-primary btn-block" :href="routes.cartCheckoutRoute">Checkout</a>
               </li>
           </ul>
       </li>
   </div>
    <div>
        <!-- Wishlist -->
        <li class="nav-item dropdown dropdown-notification mr-25">
            <a class="nav-link" :href="routes.wishlistRoute">
                <i class="ficon" data-feather="heart"></i>
                <span v-if="wishlistCounter > 0" class="badge badge-pill badge-danger badge-up wishlist-count-badge">{{ wishlistCounter }}</span>
            </a>
        </li>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    props: ['productShowRoute','checkoutRoute', 'wishlistRoute'],
    data() {
        return {
            routes: {
                productShowRoute: this.productShowRoute,
                cartCheckoutRoute: this.checkoutRoute,
                wishlistRoute: this.wishlistRoute,
            },
        }
    },

    created(){
         this.$store.dispatch('cart/fetchCarts');
         this.$store.dispatch('wishlist/fetchWishlist');
    },

    methods: {
        removeFromCart(id) {
          this.$store.dispatch('cart/removeFromCart', id);
      }
    },

    computed: {
        ...mapGetters({
            carts: 'cart/cartItems',
            totalPrice: 'cart/totalPrice',
            wishlistCounter: 'wishlist/wishlistCounter',

        })
    }
}
</script>
<style scoped>
.media:hover .remove-cart {
    visibility : visible;
}
.remove-cart {
    position : absolute;
    top : 5px;
    right : 15px;
    width : 14px;
    height : 14px;
    cursor : pointer;
}

@media (min-width: 768px) {
    .remove-cart {
        visibility : hidden;
    }
}
</style>
