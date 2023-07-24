import axios from 'axios';
import router from '@/router';
import baseApi from '@/auth/api'

export default {
    login({ commit }, data) {
        commit('SET_USER', data);
        commit('SET_AUTHENTICATION', true);
        commit('SET_PROCESSING', false);
    },

    async logout({commit}){
       await baseApi.post('/api/logout')
           .then(({data})=>{
               commit('CLEAR_USER_DATA')
               commit('SET_AUTHENTICATION',false)
           }).catch(({error})=> {
               console.log(error)
           })
    }
};
