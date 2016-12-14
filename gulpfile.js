const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
require('laravel-elixir-webpack-official');//加载webpack  laravel扩展

/**
 * [watch 配置webpack参数 来实现laravel-elixir-webpack-official  配置]
 * @type {[type]}
 */
var webpack = require('webpack');
Elixir.webpack.config.module.loaders = [];//官方配置有BUG在这里重新定义loaders
Elixir.webpack.mergeConfig({
    watch: Elixir.isWatching(),
    watchOptions: {
        poll: true,
        aggregateTimeout: 500,
        ignored: /node_modules/
    },
    devtool: Elixir.config.sourcemaps ? 'eval-cheap-module-source-map' : '',
    module: {
        loaders: [{ test: /\.js$/, loader: 'buble' }],
        loaders: [{ test: /\.css$/, loader: 'style-loader!css-loader!less-loader' }]
    },

    plugins: [
         new webpack.ProvidePlugin({
             "$": "jquery",
             "jQuery": "jquery",
             "window.jQuery": "jquery",
             "Vue": "vue"
         })
    ],
    stats: {
        assets: false,
        version: false
    }
});
elixir(function(mix) {
    mix.browserSync({
        proxy: 'vue.dev'
    });
    mix.webpack('main.js');

});
