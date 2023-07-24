export default {
    authenticated(state){
        return state.authenticated
    },

    user(state){
        return state.user
    },

    processing(state){
        return state.processing
    },

    errors(state){
        return state.validationErrors

    }
}
