const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .setPublicPath('build')
    .setResourceRoot('.') // Relative
    .js('resources/js/migrations-ui.js', 'build')
    .sass('resources/sass/migrations-ui.scss', 'build')
    .copy('resources/img/favicon.png', 'build');
