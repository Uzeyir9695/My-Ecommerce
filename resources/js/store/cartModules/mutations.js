export default {
    addToCart(state, product) {
        state.cartItems.push(product);
    },

    updateCart(state, cart) {
        // first check if cart exists with same ID, replace it with new one with same ID with updated price and quantity
        const existingCartIndex = state.cartItems.findIndex(item => item.id === cart.id);
        if (existingCartIndex !== -1) {
            state.cartItems.splice(existingCartIndex, 1, cart);
        } else {
            state.cartItems.push(cart);
        }
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
