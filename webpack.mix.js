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

const APP_PATHS = {
    'entryAbs': path.join(__dirname, 'resources/assets/js/app.js'),
    'publicAbs': path.join(__dirname, 'public/assets'),
    'public': '/assets/',
    'js': 'js/[name].js',
    'css': 'css/[name].css',
    'img': 'img/[name].[ext]',
    'fonts': 'fonts/[name].[ext]'
};

mix.webpackConfig({
    resolve: {
        alias: {
            'va': 'vue2-admin-lte/src'
        }
    },
    module: {
        loaders: [
            /* Relocate large images to the IMG directory */
            {
                test: /\.(png|jpe?g|gif|svg)$/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 10000,
                        name: APP_PATHS.img
                    }
                }]
            },

            /* Relocate fonts to the FONTS directory */
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 10000,
                        name: APP_PATHS.fonts
                    }
                }]
            }
        ]
    }
});

mix.autoload({
    'moment': ['moment', 'window.moment'],
})

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/dashboard.js', 'public/js')
    .js('resources/assets/js/oauth.js', 'public/js')
    .js('resources/assets/js/addtask.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');