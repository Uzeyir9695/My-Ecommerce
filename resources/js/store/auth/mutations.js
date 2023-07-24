import axios from  'axios'
export default {
    SET_AUTHENTICATION(state, value) {
        state.authenticated = value
    },

    SET_USER(state, value) {
        state.user = value.user
        localStorage.setItem('token', value.token)
        axios.defaults.headers.common.Authorization = `Bearer ${value.token}`
    },

    CLEAR_USER_DATA(state) {
        state.user = {}
        localStorage.removeItem('token')
        delete axios.defaults.headers.common.Authorization;
    },

    SET_ERRORS(state, value) {
        state.validationErrors = value
    },

    SET_PROCESSING(state, value) {
        state.processing = value
    }
}
