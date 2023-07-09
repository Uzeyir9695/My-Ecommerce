import axios from 'axios';

export default {
    async addProduct(context, product_id) {
        try {
            const response = await axios.post('/products', {'id': product_id});
            context.commit('addProduct');
            return response;
        } catch (error) {
            console.error(error); // Log the error
            throw error;
        }
    },

     async fetchProducts({ commit }, payload) {
        try {
            const url = payload.paginateRoute ? payload.paginateRoute : payload;
            const params = {}; // Create an empty object for the params

            if (payload.filters && Object.keys(payload.filters).length > 0) {
                params.filters = payload.filters; // Assign filters to params only if it's not an empty object
            }

            const response = await axios.get(url, { params }); // Fetch products from EcommerceController.php
            commit('product/contentLoading', true, { root: true }); // Set contentLoading to true before a slight delay

            // Note: in normal case no need to use settimout callback funcition to show a spinner
            setTimeout(() => {
                commit('fetchProducts', response.data);
                commit('paginateProducts', response.data.products);
                commit('product/contentLoading', false, { root: true }); // Set contentLoading back to false after the delay
            }, 300);

            return response;
        } catch (error) {
            console.error(error); // Log the error
            throw error;
        }
    },

    async removeProduct(context, id) {
        try {
            const response = await axios.delete('/products/'+id);
            context.commit('removeProduct', id);
            toastr['error']('', 'Removed Item 🗑️', {
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
