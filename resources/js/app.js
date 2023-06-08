import './bootstrap';
import { createApp} from "vue";
import ProductIndex from './products/ProductIndex.vue'

createApp({
    components: {
        ProductIndex
    }
}).mount('#app');

