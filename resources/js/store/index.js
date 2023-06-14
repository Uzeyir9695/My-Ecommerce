import { createStore } from 'vuex'
import cart from './cartModules/index'
import wishlist from './wishlistModules/index'
import product from './productModules/index'
export default createStore({
    modules: {
        cart,
        wishlist,
        product,
    }
})
