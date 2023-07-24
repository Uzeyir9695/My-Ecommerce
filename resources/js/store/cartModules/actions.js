import baseApi from '@/auth/api'

export default {
    async addToCart(context, product) {
        try {
            const response = await baseApi.post('/api/carts', product);
            context.commit('addToCart', response.data.cart);
            toastr['success']('', response.data.message+' 🛒', {
                closeButton: true,
                tapToDismiss: false,
            });
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    },

    async updateCart(context, cart) {
        try {
            const response = await baseApi.put('/api/carts/'+cart.id, cart);
            context.commit('updateCart', response.data.cart);
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    },

    async fetchCarts(context) {
        try {
            const response = await baseApi.get('/api/navbar-carts');
            context.commit('pushCarts', response.data.carts);
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    },

    async removeFromCart(context, id) {
        try {
            const response = await baseApi.delete('/api/carts/'+id);
            context.commit('removeFromCart', id);
            toastr['error']('', response.data.message+' 🛒', {
                closeButton: true,
                tapToDismiss: false,
            });
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    }
};
