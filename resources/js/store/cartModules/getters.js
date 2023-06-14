export default {
    cartItems(state) {
        return state.cartItems;
    },

    totalPrice(state, getters) {
        return getters.cartItems.reduce((total, cartItem) => total + cartItem.price, 0);
    }
}
