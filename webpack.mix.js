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
    .sass('resources/sass/theme.scss', 'public/css/theme.css')
    .js('resources/js/app.js', 'public/js').sourceMaps();

mix.js('resources/js/custom.js', 'public/js');

mix.copy('resources/js/custom_voyager.js', 'public/js/');

mix.sass('resources/sass/custom/custom_voyager.scss', 'public/css');

mix.copy([
    'node_modules/flatpickr/dist/flatpickr.js',
    'node_modules/flatpickr/dist/l10n/pl.js',
    'node_modules/jquery.are-you-sure/jquery.are-you-sure.js'
], 'public/js');

