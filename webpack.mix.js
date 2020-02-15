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
    .setResourceRoot('.') // Relative
    .sourceMaps()
    .js('resources/js/app.js', 'build')
    .sass('resources/sass/app.scss', 'build')
    .copy('resources/img/favicon.png', 'build');

if (mix.inProduction()) {
    mix.version();
}

// Local config for setting the hostname
const localConfig = path.join(__dirname, 'webpack.mix.local.js');
if (fs.existsSync(localConfig)) {
    require(localConfig);
}
