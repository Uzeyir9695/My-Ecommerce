import axios from 'axios';

export default {
    async addToCart(context, product) {
        try {
            const response = await axios.post('/carts', product);
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
            const response = await axios.put('/carts/'+cart.id, cart);
            context.commit('updateCart', response.data.cart);
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    },

    async fetchCarts(context) {
        try {
            const response = await axios.get('/navbar-carts');
            context.commit('pushCarts', response.data.carts);
            return response;
        } catch (error) {
            console.error(error);
            throw error;
        }
    },

    async removeFromCart(context, id) {
        try {
            const response = await axios.delete('/carts/'+id);
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
