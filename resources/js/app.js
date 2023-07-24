import './bootstrap';
import { createApp } from 'vue';
import store from '@/store';
import router from '@/router';
// Packages
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Components
import CategoryProducts from './main/CategoryProducts.vue';
import Index from './main/Index.vue';
import ProductCreate from './products/Create.vue';
import ProductEdit from './products/Edit.vue';
import ShopCreate from './shops/Create.vue';
import ShopEdit from './shops/Edit.vue';
import CartList from './cart/CartList.vue';
import CartWishlistButtons from './cart/CartWishlistButtons.vue';
import Checkout from './cart/Checkout.vue';
import Wishlist from './wishlist/Wishlist.vue';
import App from './App.vue';

const app = createApp(App);
// Register FontAwesomeIcon component globally
app.use(store);
app.use(router);
app.use(VueSweetalert2);
app.component('font-awesome-icon', FontAwesomeIcon);
window.Swal =  app.config.globalProperties.$swal;
app.mount('#app');
