import LoadingPage from './pages/Loading';

function loadingIndicator(componentPromise) {
    // Vue Router doesn't natively support loading indicators but this makes it
    // possible by wrapping them in a functional component.
    // WARNING: Components loaded with this strategy will not have access to
    // in-component guards, such as beforeRouteEnter, beforeRouteUpdate and beforeRouteLeave.
    // https://github.com/vuejs/vue-router/pull/2140
    // https://vuejs.org/v2/guide/components-dynamic-async.html#Handling-Loading-State
    const AsyncHandler = () => ({
        component: componentPromise,
        delay: 0,
        loading: LoadingPage,
        // timeout: 10000,
        // error: TimeoutPage,
    });

    return Promise.resolve({
        functional: true,
        render: (h, { data, children }) => h(AsyncHandler, data, children),
    });
}

export default [
    {
        // Vue Router can't be configured to drop the trailing / on the homepage
        //   https://github.com/vuejs/vue-router/issues/2945
        // While Laravel removes the trailing / on every page
        //   https://github.com/laravel/laravel/blob/c78a1d8/public/.htaccess#L12-L15
        // So as a workaround we redirect to another URL, like Telescope does
        //   https://github.com/laravel/telescope/blob/2.0/resources/js/routes.js
        path: '/',
        redirect: '/list',
    }, {
        path: '/list',
        component: () => loadingIndicator(import('./pages/List')),
    }, {
        path: '/migration-details/:name',
        component: () => loadingIndicator(import('./pages/MigrationDetails')),
        props: true,
    }, {
        path: '*',
        component: () => loadingIndicator(import('./pages/404')),
    },
];
