import axios from 'axios';
import store from './store';

const api = axios.create({
    baseURL: document.body.dataset.baseUrl + '/api',
    headers: {
        // Stop Laravel converting exceptions to JSON
        'Accept': 'text/html',
    }
});

// Global error handler
api.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {

        // Display the full HTML error in a popup window
        if (error.response) {
            store.commit('errors/showError', error.response.data);
        }

        return Promise.reject(error);
    },
);

export default api;
