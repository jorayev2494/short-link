
import { createStore } from 'vuex';
import errors from './modules/errors/index.js';
import links from './modules/links/index.js';

const store = createStore({
    modules: {
        errors,
        links
    }
});

export default store; 