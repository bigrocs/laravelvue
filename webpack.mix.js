const { mix } = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

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

mix.js('resources/assets/js/admin.js', 'public/js');
mix.js('resources/assets/js/cms.js', 'public/js');
mix.webpackConfig({
    plugins: [
        new BrowserSyncPlugin({
          open: 'external',
          host: 'laravelvue.dev',
          proxy: 'laravelvue.dev',
          files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
        })
    ]
})
// mix.sass('resources/assets/sass/bootstrap.scss', 'public/css');
