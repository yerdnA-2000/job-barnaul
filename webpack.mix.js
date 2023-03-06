const mix = require('laravel-mix');

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

mix.styles([
    'resources/assets/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/plugins/fontawesome-free-6.1.1-web/css/all.min.css',
    'resources/assets/css/adminlte.min.css',
    'resources/assets/css/main.css',
    'resources/assets/plugins/select2/css/select2.css',
    'resources/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
    'resources/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
], 'public/assets/css/all.min.css');

mix.scripts([
    'resources/assets/plugins/jquery/jquery.min.js',
    'resources/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/plugins/bootstrap/js/bootstrap-switch.js',
    'resources/assets/plugins/select2/js/select2.full.js',
    'resources/assets/js/adminlte.min.js',
    /*'resources/assets/js/demo.js',*/
    'resources/assets/js/main.js'
], 'public/assets/js/all.js');

mix.copyDirectory('resources/assets/plugins/fontawesome-free/webfonts', 'public/assets/webfonts');
mix.copyDirectory('resources/assets/img', 'public/assets/img');
mix.copyDirectory('resources/assets/img', 'public/assets/img');

mix.copy('resources/assets/css/adminlte.min.css.map', 'public/assets/css/adminlte.min.css.map');
mix.copy('resources/assets/js/adminlte.min.js.map', 'public/assets/js/adminlte.min.js.map');
