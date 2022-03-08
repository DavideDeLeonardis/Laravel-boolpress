const mix = require('laravel-mix');

mix.js('resources/js/admin.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css');
