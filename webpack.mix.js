const mix = require('laravel-mix');

var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});

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

// mix.js('resources/js/app.js', 'public/js');
// mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/product_detail.scss', 'public/css');
