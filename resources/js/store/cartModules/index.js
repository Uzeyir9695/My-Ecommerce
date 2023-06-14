import mutations from "./mutations";
import getters from "./getters";
import actions from "./actions";

export default {
    // namespace the module
    namespaced: true,
    state() {
        return {
            cartItems: []
        }
    },
    mutations: mutations,
    getters: getters,
    actions: actions
}
