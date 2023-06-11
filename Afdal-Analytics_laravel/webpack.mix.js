const mix = require('laravel-mix');
require('laravel-mix-purgecss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts([
    'public/assets/js/jquery-3.6.1.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/v2/moment.min.js',
    'public/assets/js/v2/daterangepicker.js',
    'public/assets/js/custom.js'
], 'public/js/app.js').minify('public/js/app.js')
    .styles([
        'public/web_public/assets/assets/icons/font-awesome/css/fontawesome-all.min.css',
        'public/assets/css/bootstrap.min.css',
        'public/assets/css/style.css',
        'public/assets/css/v2/daterangepicker.css',
    ], 'public/css/app.css').minify('public/css/app.css').purgeCss({
        enabled: true,
    });

//v2 assets
mix.scripts([
    'public/assets/js/jquery-3.6.1.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/v2/bootstrap.min.js',
    'public/assets/js/v2/bootstrap.bundle.min.js',
    'public/assets/js/v2/moment.min.js',
    'public/assets/js/v2/daterangepicker.js',
    'public/assets/js/v2/custom.js'
], 'public/js/v2/app.js').minify('public/js/v2/app.js')
    .styles([
        'public/web_public/assets/assets/icons/font-awesome/css/fontawesome-all.min.css',
        'public/assets/css/v2/bootstrap.min.css',
        'public/assets/css/v2/style.css',
        'public/assets/css/v2/daterangepicker.css',
    ], 'public/css/v2/app.css').minify('public/css/v2/app.css').purgeCss({
        enabled: true,
    });


// Live browser refrech run ==> npm run watch 
mix.browserSync({
    proxy: 'http://127.0.0.1:8000'
})
