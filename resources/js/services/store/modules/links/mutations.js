export function setLinks(state, payload) {
    return state.links = payload;
}

export function pushLink(state, payload) {
    return state.links.push(payload);
}

export function setErrors(state, payload) {
    return state.errors = payload;
}