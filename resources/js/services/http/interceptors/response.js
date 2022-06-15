import store from '../../store/index.js'

export function response(response) {
    window.console.log(`Interceptor (response) => {method: ${response.config.method}, url: ${response.config.url}}:  `, response);

    return response;
}

export function error(error) {
    let errorResponse = error.response;
    window.console.warn(`Interceptor (error.response) => {method: ${errorResponse.method}, url: ${errorResponse.url}: `, errorResponse);

    const { status } = error.response
  
    if (error.response.status === 401) {
        window.console.warn('Server: 401', error.response);
        clearStore();
        clearLocalStorage();
    }

    if (error.response.status === 422) {
        store.commit('errors/setErrors', error.response.data.errors);
    }
  
    if (status >= 500) {
        window.console.warn('Interceptor Server: 500', error.response);
    }
  
    return error;
}

function clearStore() {
    let storeClearData = {
        'auth/setIsAuth': false,
        'auth/setAccessToken': null,
        'profile/setProfile': null
    };

    for (const key in storeClearData) {
        if (Object.hasOwnProperty.call(storeClearData, key)) {
            const val = storeClearData[key];
            store.commit(key.toString(), val);
        }
    }
}

function clearLocalStorage() {
    ['access_token', 'profile'].forEach(element => {
        window.localStorage.removeItem(element);
    });   
}