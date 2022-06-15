import axios from './http/index.js';

const services = {
    install(Vue) {
        Vue.config.globalProperties.$axios = window.axios = axios;
    }
};

export default services;