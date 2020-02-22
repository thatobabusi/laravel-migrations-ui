import axios from 'axios';
import errors from './stores/errors';

const api = axios.create({
    baseURL: document.body.dataset.baseUrl + '/api',
    headers: {
        // Stop Laravel converting exceptions to JSON
        'Accept': 'text/html',
    },
});

// Automatically add CSRF token
api.interceptors.request.use(function (request) {
    if (request.method.toLowerCase() !== 'get' && typeof request.data === 'object') {
        request.data._token = document.body.dataset.csrfToken;
    }

    return request;
});

// Global error handler
api.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {

        // Display the full HTML error in a popup window
        if (error.response) {
            errors.show(error.response.data);
        }

        return Promise.reject(error);
    },
);

export default api;
