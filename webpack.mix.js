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
    .sass('./resources/sass/app.scss', 'public/css')
    .sass('./resources/sass/site.scss', 'public/css')
    .sass('./resources/sass/dashboard/style.scss', 'public/css/dashboard')
    .copy('./node_modules/@fortawesome/fontawesome-free/webfonts/**', 'public/webfonts')
    .copy('./node_modules/@fortawesome/fontawesome-free/webfonts/**', 'public/css/webfonts')
    .copy('./node_modules/@icon/themify-icons/icons/**', 'public/css/dashboard/icons')
    .copy('./node_modules/@icon/themify-icons/themify-icons.eot', 'public/css/dashboard')
    .copy('./node_modules/@icon/themify-icons/themify-icons.ttf', 'public/css/dashboard')
    .copy('./node_modules/@icon/themify-icons/themify-icons.woff', 'public/css/dashboard')
    .copy('./node_modules/slick-carousel/slick/fonts/**', 'public/css/fonts')
    .copy('./node_modules/slick-carousel/slick/ajax-loader.gif', 'public/css')
    .copy('./node_modules/summernote/dist/font/**', 'public/css/dashboard/font')
    .styles([
        './node_modules/noty/lib/noty.css',
        './node_modules/noty/lib/themes/mint.css',
        './node_modules/slick-carousel/slick/slick.css',
        './node_modules/slick-carousel/slick/slick-theme.css',
    ], 'public/css/styles.css')
    .styles([
        './node_modules/c3/c3.min.css',
        './node_modules/jvectormap/jquery-jvectormap.css',
        './node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css',
        './node_modules/noty/lib/noty.css',
        './node_modules/noty/lib/themes/mint.css',
        './node_modules/summernote/dist/summernote-bs4.css',
        './node_modules/air-datepicker/dist/css/datepicker.min.css',
        './node_modules/@icon/themify-icons/themify-icons.css',
        './node_modules/chart.js/dist/Chart.min.css',
        'public/css/dashboard/style.css',
    ], 'public/css/dashboard/styles.css')
    .combine([
        'public/js/app.js',
        './node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
        './node_modules/moment/min/moment.min.js',
        './node_modules/moment/locale/pt-br.js',
        './node_modules/noty/lib/noty.min.js',
        './node_modules/slick-carousel/slick/slick.min.js',
        './resources/js/scripts.js',
    ], 'public/js/scripts.js')
    .combine([
        'public/js/app.js',
        './node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
        './node_modules/moment/min/moment.min.js',
        './node_modules/moment/locale/pt-br.js',
        './node_modules/noty/lib/noty.min.js',
        './node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js',
        './node_modules/chartist/dist/chartist.min.js',
        './node_modules/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js',
        './node_modules/d3/dist/d3.min.js',
        './node_modules/c3/c3.min.js',
        './node_modules/jvectormap/jquery-jvectormap.min.js',
        './node_modules/jvectormap-content/world-mill.js',
        './node_modules/summernote/dist/summernote-bs4.js',
        './node_modules/feather-icons/dist/feather.min.js',
        './node_modules/air-datepicker/dist/js/datepicker.min.js',
        './node_modules/air-datepicker/dist/js/i18n/datepicker.pt-BR.js',
        './node_modules/chart.js/dist/Chart.min.js',
        './resources/js/dashboard/app-style-switcher.js',
        './resources/js/dashboard/sidebarmenu.js',
        './resources/js/dashboard/charts.js',
        './resources/js/dashboard/custom.js',
    ], 'public/js/dashboard/scripts.js')
    .options({
            processCssUrls: false
        });
