export async function loadLinkAsync({ commit }, _) {
    return await new Promise((resolve, reject) => {
        window.axios.get('/').then((response) => {
            commit('setLinks', response.data);
        }).catch((err) => {

            reject(err);
        });
    })
}

export async function createLinkAsync({ commit }, payload) {
    return await new Promise((resolve, reject) => {
        window.axios.post('/', payload).then((response) => {
            commit('pushLink', response.data);
            resolve(response.data);
        }).catch((err) => {
            commit('errors/setErrors', err.response.data.errors, { root: true });
            reject(err);
        });
    })
}