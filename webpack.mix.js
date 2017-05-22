const { mix } = require('laravel-mix');
//
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
// .sass('resources/assets/sass/app.scss', 'public/css')
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/quote.js', 'public/js/quote.js')
    .js('resources/assets/js/staff.js', 'public/js/staff.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/bootflat.scss','public/css');
    // .js('resources/assets/js/quote.js','public/js');
// mix.scripts('resources/assets/js/quote.js','public/js/quote.js');
