import './bootstrap';
import { createApp } from 'vue';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import store from './store';
import Index from './products/Index.vue';
import CartList from './cart/CartList.vue';
import Wishlist from './wishlist/Wishlist.vue';

const app = createApp({
    components: {
        Index,
        CartList,
        Wishlist
    }
});
// Register FontAwesomeIcon component globally
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(store);
app.mount('#app');
