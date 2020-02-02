const mix = require('laravel-mix');

mix.options({
    hmrOptions: {
        host: 'migrations-ui.test',
        port: 8080
    }
});
