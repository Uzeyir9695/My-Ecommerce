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
                            <h2 class="content-header-title float-left mb-0">Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  d-flex justify-content-center" :class="{'d-none': !isCartEmpty}">
                <div>
                    <div class="text-center"><h1 class="mt-2">Your Cart Is Empty</h1></div>
                </div>
            </div>
            <!--  Start checkout steps          -->
            <div class="content-body" v-show="carts.length > 0">
                <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-cart">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Cart</span>
                                    <span class="bs-stepper-subtitle">Your Cart Items</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-address">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="home" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Address</span>
                                    <span class="bs-stepper-subtitle">Enter Your Address</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-payment">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="credit-card" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Payment</span>
                                    <span class="bs-stepper-subtitle">Select Payment Method</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    <div v-for="cart in carts" :key="cart.id" class="card ecommerce-card" id="cart-item-wrapper-{{ cart.id }}">
                                        <div class="item-img">
                                            <a :href="productShowRoute+'/'+cart.product_id">
                                                <img :src="cart.product.media[0].original_url" class="rounded" alt="img-placeholder" />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0"><a :href="productShowRoute+'/'+cart.product_id" class="text-body">{{ cart.product.name }}</a></h6>
                                                <span class="item-company">By <a href="javascript:void(0)" class="company-name">E-Commerce</a></span>
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
                                            <span class="text-success mb-1">In Stock</span>
                                            <div class="item-quantity">
                                                <span class="quantity-title">Qty:</span>
                                                <div class="checkout-quantity-wrapper d-flex justify-content-center" style="width: 100px;">
                                                    <font-awesome-icon @click="minus(cart)" class="minus mr-1 text-primary" style="font-size: 20px; cursor: pointer; font-weight: 600" icon="circle-minus" />
                                                    <span class="quantity" style="font-size: 15px; font-weight: 600">{{ cart.quantity }}</span>
                                                    <font-awesome-icon @click="plus(cart)" class="plus ml-1 text-primary" style="font-size: 20px; cursor: pointer; font-weight: 600" icon="circle-plus" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <h4 class="item-price"><span id="checkout-price-{{ cart.id }}">{{ cart.price }} USD</span></h4>
                                                    <p class="card-text shipping">
                                                        <span class="badge badge-pill badge-light-success">Free Shipping</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-light mt-1" @click="removeFromCart(cart.id)">
                                                <i data-feather="x" class="align-middle mr-25"></i>
                                                <span>Remove</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-cart" @click="addToWishlist(cart.product_id)">
                                                <font-awesome-icon icon="heart" class="align-middle mr-25"  :class="{ 'text-danger': isProductInWishlist(cart.product_id), 'text-muted': !isProductInWishlist(cart.product_id) }"/>
                                                <span class="text-truncate">Add to Wishlist</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Place Order Left ends -->

                                <!-- Checkout Place Order Right starts -->
                                <div class="checkout-options">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="section-label mb-1">Options</label>
                                            <div class="coupons input-group input-group-merge">
                                                <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-primary" id="input-coupons">Apply</span>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Price Details</h6>
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Delivery Charges</div>
                                                        <div class="detail-amt discount-amt text-success">Free</div>
                                                    </li>
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title detail-total">Total</div>
                                                        <div class="detail-amt font-weight-bolder"><span >{{ totalPrice }} USD</span></div>
                                                    </li>
                                                </ul>
                                                <button type="submit" class="btn btn-primary btn-block btn-next place-order">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout Place Order Right ends -->
                                </div>

                                <!-- E-commerce Pagination Starts -->
<!--                                <section id="ecommerce-pagination">-->
<!--                                </section>-->
                                <!-- E-commerce Pagination Ends -->
                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>
                        <!-- Checkout Customer Address Starts -->

                        <div id="step-address" class="content">
                            <form id="checkout-address form2" class="list-view product-checkout">
                                <!-- Checkout Customer Address Left starts -->
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Add New Address</h4>
                                        <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-name">Full Name <span class="text-danger">*</span>:</label>
                                                    <input v-model="fullname" name="fullname" type="text" class="form-control" placeholder="John Doe" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-email">E-Mail <span class="text-danger">*</span>:</label>
                                                    <input v-model="email" name="email" type="email" class="form-control" placeholder="example@gmail.com" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-mobile">Mobile Number <span class="text-danger">*</span>:</label>
                                                    <input v-model="mobile" name="mobile" type="text" class="form-control" placeholder="+995555444333" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-country">Country <span class="text-danger">*</span>:</label>
                                                    <input v-model="country" name="country" type="text" class="form-control" placeholder="Georgia" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-zipcode">ZIP-Code <span class="text-danger">*</span>:</label>
                                                    <input v-model="zipcode" name="zipcode" type="number" class="form-control" placeholder="201301" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-city">City <span class="text-danger">*</span>:</label>
                                                    <input v-model="city" name="city" type="text" class="form-control" placeholder="Tbilisi" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-apt-number">Flat, House No <span class="text-danger">*</span>:</label>
                                                    <input v-model="aptnumber" name="aptnumber" type="number" class="form-control" placeholder="9447 Glen Eagles Drive" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-landmark">Landmark e.g. near apollo hospital:</label>
                                                    <input v-model="landmark" name="landmark" type="text" class="form-control" placeholder="Near Apollo Hospital" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary btn-next delivery-address">Save And Deliver Here</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Left ends -->
                            </form>
                        </div>
                        <!-- Checkout Customer Address Ends -->

                        <!-- Checkout Payment Starts -->
                        <div id="step-payment" class="content">
                            <div class="payment-type">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Payment options</h4>
                                        <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-4 col-md-6">
                                            <div id="card-element"></div>
                                        </div>
                                        <div id="card-errors" class="ml-1 text-danger mt-1" role="alert">
                                            {{ cardError ? cardError: orderAddressError? 'Oops, in the previous step ' + orderAddressError + ' Please go back and fill all the necessery info as required.': '' }}
                                        </div>
                                        <div class="form-group mt-3">
                                            <a type="button" href="javascript:void(0)" class="btn btn-success">Amount Payable: <span id="checkout-total-price">{{ totalPrice }} USD</span></a>
                                            <button @click.prevent="processPayment" class="btn btn-primary pay-now ml-1" :disabled="isPaying">
                                                <span v-if="isPaying" class="spinner-border spinner-border-sm"></span>
                                                {{ isPaying ? 'Processing...' : 'Pay now'}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Payment Ends -->
                    </div>
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
        paymentRoute: {
            type: String
        },
    },
    data() {
        return {
            routes: {
                productShow: this.productShowRoute,
                paymentRoute: this.paymentRoute,
            },
            isPaying: false,
            cardError: null,
            orderAddressError: null,
            orderedItems: [],

            fullname: '',
            email: '',
            mobile: '',
            country: '',
            zipcode: '',
            city: '',
            aptnumber: '',
            landmark: '',

            stripe: '',
            elements: '',
            card: '',
            wishlistId: null,
            isCartEmpty: false
        }
    },

    computed: {
        ...mapGetters({
            carts: 'cart/cartItems',
            totalPrice: 'cart/totalPrice',
            wishlist: 'wishlist/wishlists',
        }),

        isProductInWishlist() {
            return function(productId) {
                return this.wishlist.some(wishlist => wishlist.product_id === productId); // Check if a product already exists in wishlist to avoid duplication
            }
        }
    },

    updated(){
        if(this.carts.length < 1) {
            this.isCartEmpty = true
        }
    },

    mounted() {
        // Load Stripe.js library
        const script = document.createElement('script');
        script.src = 'https://js.stripe.com/v3/';
        script.onload = () => {
            this.initializeStripe();
        };
        document.head.appendChild(script);
    },

    methods: {
        initializeStripe() {
            const stripe = Stripe('pk_test_51L8i7sFAuQKMVqwjwrxxPj38hR3oLMeQZhuGhR8u8FgqBW5Puw0Kh649BBKqJcp7f2OZefiV8TfH8nQmSMlVCLJK00DBG2sPnZ');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                hidePostalCode: true
            });
            cardElement.mount('#card-element');

            this.stripe = stripe;
            this.cardElement = cardElement;
        },

        processPayment() {
            // Before payment valdiate order address info and display the error messages
            axios.post('/orders/address/validate',
                {
                    fullname: this.fullname,
                    email: this.email,
                    mobile: this.mobile,
                    country: this.country,
                    zipcode: this.zipcode,
                    city: this.city,
                    aptnumber: this.aptnumber,
                    landmark: this.landmark,
                })
                .then((response) => {
                    if(response.status === 200) {
                        // Handle the payment using Stripe.js
                        this.isPaying = true;

                        this.stripe
                            .createPaymentMethod({
                                type: 'card',
                                card: this.cardElement,
                                billing_details: {
                                    name: this.fullname,
                                    email: this.email,
                                    address: {
                                        city: this.city,
                                        postal_code: this.zipcode,
                                        country: 'GE',
                                    },
                                },
                            })
                            .then((result) => {
                                if (result.error) {
                                    // Handle error
                                    this.isPaying =  false;
                                    this.cardError = result.error.message;
                                } else {
                                    // Payment method created successfully
                                    const paymentMethod = result.paymentMethod.id;
                                    this.processPaymentOnServer(paymentMethod);
                                }
                            });
                    }
                })
                .catch((error) => {
                if (error.response && error.response.status === 422) {
                    this.isPaying = false;
                    // Validation failed, store the errors
                    const errors = error.response.data.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            const errorMessage = errors[field][0];
                            this.orderAddressError = errorMessage;
                        }
                    }
                }
                });
        },

        processPaymentOnServer(paymentMethod) {
            // Send the payment method to your server for processing
            axios.post('/payment', {
                    payment_method: paymentMethod,
                    amount: this.totalPrice,
                })
                .then((response) => {
                    this.orderDetails();

                    // Set this.isPaying to false after 1-second delay
                    setTimeout(() => {
                        this.isPaying = false;
                    }, 1000);

                    // Redirect to the specified URL
                    window.location.href = 'http://127.0.0.1:8000/payment-success';
                })
                .catch((error) => {
                    // Handle error
                    console.error(error.data.error);
                });
        },

        async orderDetails() {
            const addressInfo = {
                fullname: this.fullname,
                email: this.email,
                mobile: this.mobile,
                country: this.country,
                zipcode: this.zipcode,
                city: this.city,
                aptnumber: this.aptnumber,
                landmark: this.landmark,
            };

            this.orderedItems = this.carts.map(cart => {
                return {
                    id: cart.id,
                    product_id: cart.product_id,
                    price: cart.price,
                    quantity: cart.quantity,
                    discount: cart.discount
                };
            });

            await axios.post('/orders/detail', {'orderedItems': this.orderedItems})
                .then((response) => {
                    return response;
                }).catch((error) => {
                    console.error(error); // Log the error
                });

            await axios.post('/orders/address', addressInfo)
                .then((response) => {
                    return response;
                }).catch((error) => {
                    console.error(error); // Log the error
                });
        },

        removeFromCart(id) {
            this.$store.dispatch('cart/removeFromCart', id);
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

        minus(cart) {
            var minQuantity = 1;
            if(cart.quantity > minQuantity) {
                cart.quantity--
            }

            this.calculateTotalPrice(cart);
        },

        plus(cart) {
            var maxQuantity = 10;
            if(cart.quantity < maxQuantity) {

                cart.quantity++
            }
            this.calculateTotalPrice(cart);
        },

        calculateTotalPrice(cart) {
            const discountedPrice = this.price(cart.product.price, cart.discount);
            const discountedTotalPrice = discountedPrice * cart.quantity;
            const item = {
                id: cart.id,
                product_id: cart.product_id,
                price: discountedTotalPrice,
                quantity: cart.quantity,
                discount: cart.discount
            }
            this.$store.dispatch('cart/updateCart', item);
        },

        // calculate product's discount
        price(price, discount=0){
            return price - (price*discount/100);
        },
    },
}
</script>
