const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const fs = require('fs');
const mix = require('laravel-mix');
const path = require('path');

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
    .sourceMaps()
    .js('resources/js/app.js', 'build')
    .sass('resources/sass/app.scss', 'build')
    .copy('resources/img/favicon.png', 'build');

if (mix.inProduction()) {
    mix
        .webpackConfig({
            plugins: [new CleanWebpackPlugin()],
        })
        .version()
        .webpackConfig({
            output: {
                chunkFilename: 'chunk-[contenthash].js',
            },
        });
}

// Set hostname & port for hot module reloading, if set in .env
require('dotenv').config();

if (process.env.WEBPACK_HMR_HOST) {
    mix.options({
        hmrOptions: {
            host: process.env.WEBPACK_HMR_HOST,
            port: process.env.WEBPACK_HMR_PORT,
        }
    });
}
