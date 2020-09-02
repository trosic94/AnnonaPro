let mix = require('laravel-mix');

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
   // .js('node_modules/mdbootstrap-pro/js/jquery.js', 'public/js')
   // .js('node_modules/mdbootstrap-pro/js/popper.js', 'public/js')
   // .js('node_modules/mdbootstrap-pro/js/bootstrap.js', 'public/js')
   // .js('node_modules/mdbootstrap-pro/js/mdb.js', 'public/js')
   .js('resources/assets/js/shp.js', 'public/js')
   //.sass('resources/assets/sass/shp.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/voyager.scss', 'public/css')
   //.sass('node_modules/mdbootstrap-pro/scss/mdb-pro.scss', 'public/css');
   .sourceMaps();
