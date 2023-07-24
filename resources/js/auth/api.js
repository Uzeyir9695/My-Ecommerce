import axios from 'axios';

// Put your backend URL here
export const API_URL = import.meta.env.BASE_URL;

const baseApi = axios.create({
    baseURL: API_URL,
});

baseApi.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
});

export default baseApi;
