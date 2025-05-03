const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | This section sets up Laravel Mix for asset compilation.
 | The paths are configured to work properly with a subdomain deployment.
 |
 */

mix.setPublicPath('public'); // Sets the output directory to 'public'

mix.js('resources/js/app.js', 'js') // Compile JavaScript to 'public/js/app.js'
    .postCss('resources/css/app.css', 'css', [
        // You can add PostCSS plugins here (e.g., autoprefixer)
    ])
    .version(); // Appends a unique hash to the filenames for cache busting (e.g., app.js?id=abcd1234)
