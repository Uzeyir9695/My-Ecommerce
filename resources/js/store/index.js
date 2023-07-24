import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import auth from './auth/index'
import cart from './cartModules/index'
import wishlist from './wishlistModules/index'
import product from './productModules/index'
export default createStore({
    plugins: [createPersistedState()],
    modules: {
        auth,
        cart,
        wishlist,
        product,
    }
})
