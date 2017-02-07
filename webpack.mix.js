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

mix.js('resources/assets/js/main.js', 'public/js');
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.less$/,
                use: [
                  'style-loader',
                  { loader: 'css-loader', options: { importLoaders: 1 } },
                  'less-loader'
                ]
            },
            {
                test: /\.scss$/,
                loaders: ["style-loader", "css-loader", "sass-loader"]
            },
        ]
    },
    plugins: [
        new BrowserSyncPlugin({
          open: 'external',
          host: 'vue.dev',
          proxy: 'vue.dev',
          files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
        })
    ]
})
// mix.sass('resources/assets/sass/app.scss', 'public/css');
