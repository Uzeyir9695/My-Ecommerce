export default {
    addToCart(state, product) {
        state.cartItems.push(product);
    },

    pushCarts(state, products) {
        products.forEach((product) => {
            state.cartItems.push(product);
        });
    },
    removeFromCart(state, id) {
        const index = state.cartItems.findIndex(item => item.id === id);
        if (index !== -1) {
            state.cartItems.splice(index, 1);
        }
    }
}
