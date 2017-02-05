const elixir = require('laravel-elixir');
const path = require('path');
require('laravel-elixir-vue-2');
elixir(function(mix) {
    Elixir.webpack.mergeConfig({
        resolveLoader: {
            root: path.join(__dirname, 'node_modules'),
        },
        module: {
            loaders: [
                {
                    test: /\.css$/,
                    loader: 'style!css'
                }
            ]
        }
    });
    mix.browserSync({
        proxy: 'vue.dev'
    });
    mix.less('app.less')
        .webpack('main.js');
});
