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
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/slider-pro/dist/css/slider-pro.css',
    'node_modules/icheck-bootstrap/icheck-bootstrap.css',
    'resources/css/custom.css',
], 'public/css/template.css');

mix.js([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/slider-pro/dist/js/jquery.sliderPro.js',
    'node_modules/cleave.js/dist/cleave.min.js',
    'resources/js/custom.js',
], 'public/js/template.js')
