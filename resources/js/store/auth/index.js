import mutations from "./mutations";
import getters from "./getters";
import actions from "./actions";

export default {
    // namespace the module
    namespaced: true,
    state() {
        return {
            authenticated: false,
            user: {},
            processing: false,
            validationErrors: null
        }
    },
    mutations: mutations,
    getters: getters,
    actions: actions
}
