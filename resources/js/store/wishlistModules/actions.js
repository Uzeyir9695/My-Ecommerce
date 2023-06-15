import axios from 'axios';

export default {
    async addToWishlist(context, product_id) {
        try {
            const response = await axios.post('/wishlists', {'id': product_id});
            context.commit('addToWishlist');
            toastr['success']('', response.data.message+' 🛒', {
                closeButton: true,
                tapToDismiss: false,
            });
            return response;
        } catch (error) {
            console.error(error); // Log the error
            throw error;
        }
    },

     async fetchWishlist(context, page) {
        try {
            const response = await axios.get(`/wishlists?page=${page}`);
            context.commit('fetchWishlist', response.data.wishlists);
            context.commit('paginateWishlist', response.data.wishlists);
            return response;
        } catch (error) {
            console.error(error); // Log the error
            throw error;
        }
    },
    async removeFromWishlist(context, id) {
        try {
            const response = await axios.delete('/wishlists/'+id);
            context.commit('removeFromWishlist', id);
            toastr['error']('', response.data.message+' 🗑️', {
                closeButton: true,
                tapToDismiss: false,
            });
            return response;
        } catch (error) {
            console.error(error); // Log the error
            throw error;
        }
    }
};
