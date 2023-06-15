export default {
    addToWishlist(state) {
        state.wishlistCounter = state.wishlistCounter+1; // increment wishlist's length on each add
    },

   fetchWishlist(state, wishlists) {
       state.wishlistCounter = wishlists.total;
       state.wishlist = wishlists.data;
    },

    paginateWishlist(state, wishlists) {
       state.paginateWishlist = wishlists;
    },

    removeFromWishlist(state, id) {
        const index = state.wishlist.findIndex(item => item.id === id);
        if (index !== -1) {
            state.wishlist.splice(index, 1);
            state.wishlistCounter = state.wishlistCounter-1;
        }

    }
}
