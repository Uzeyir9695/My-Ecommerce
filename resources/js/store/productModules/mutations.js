export default {
    addProduct(state) {
        state.products = state.products; // increment products's length on each add
    },

   fetchProducts(state, data) {
       state.products = data.products.data;
       state.attributes = data.attributes
    },

    paginateProducts(state, products) {
       state.paginateProducts = products;
    },

    contentLoading(state, isLoading) {
        state.contentLoading = isLoading;
    },

    removeProduct(state, id) {
        const index = state.products.findIndex(item => item.id === id);
        if (index !== -1) {
            state.products.splice(index, 1);
        }
    }
}
