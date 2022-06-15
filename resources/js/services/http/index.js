import axios from "axios";

const SERVER_URL = 'http://127.0.0.1:8083/api' // Localhost
// const SERVER_URL = 'http://80.208.225.82:8088/api' // Develop

let projectAxios = axios.create({
    baseURL: SERVER_URL,
    timeout: 1000,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        // 'X-Custom-Header': 'foobar'
    },
    // withCredentials: true
});

export default projectAxios;