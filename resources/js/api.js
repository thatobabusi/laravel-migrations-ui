import axios from 'axios';
import errors from './stores/errors';

const api = axios.create({
    baseURL: document.body.dataset.baseUrl + '/api',
    headers: {
        // Stop Laravel converting exceptions to JSON
        'Accept': 'text/html',
    },
});

api.interceptors.request.use(function (request) {
    // Automatically add CSRF token
    if (request.method.toLowerCase() !== 'get' && typeof request.data === 'object') {
        request.data._token = document.body.dataset.csrfToken;
    }

    return request;
});

// Debugbar integration - https://github.com/barryvdh/laravel-debugbar/issues/674
// Not currently working because of the Accept header above... Not sure how to resolve that...
function addResponseToDebugbar(response) {
    if (phpdebugbar && phpdebugbar.ajaxHandler && response.request) {
        phpdebugbar.ajaxHandler.handle(response.request);
    }
}

api.interceptors.response.use(
    function (response) {
        addResponseToDebugbar(response);
        return response;
    },
    function (error) {

        // Display the full HTML error in a popup window
        if (error.response) {
            errors.show(`Error in ${error.request.responseURL}`, error.response.data);
            addResponseToDebugbar(error.response);
        }

        return Promise.reject(error);
    },
);

export default api;
