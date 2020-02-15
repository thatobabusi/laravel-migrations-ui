import axios from 'axios';

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
            const popup = window.open(
                'about:blank',
                'laravel_migrations_ui_error',
                `width=${window.screen.width * 0.9},height=${window.screen.height * 0.85}`
            );
            popup.document.open();
            popup.document.write(error.response.data);
            popup.document.close();
            popup.focus();
        }

        return Promise.reject(error);
    },
);

export default api;
