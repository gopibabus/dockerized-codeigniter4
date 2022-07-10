const path = require('path');
const mix = require('laravel-mix');

const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyPlugin = require('copy-webpack-plugin');

mix.setPublicPath('public');

mix.alias({
    '@app': path.join(__dirname, 'app/Assets'),
    '@scripts': path.join(__dirname, 'app/Assets/scripts'),
    '@utils': path.join(__dirname, 'app/Assets/scripts/utils'),
    '@constants': path.join(__dirname, 'app/Assets/scripts/constants'),
    '@pages': path.join(__dirname, 'app/Assets/scripts/pages')
});
mix.alias({
    '@styles': path.join(__dirname, 'app/Assets/styles'),
    '@style-utils': path.join(__dirname, 'app/Assets/styles/utils'),
    '@style-pages': path.join(__dirname, 'app/Assets/styles/pages')
});

mix.autoload({
    jquery: ['$', 'jQuery', 'window.jQuery'],
});

/*
 * --------------------------------------------------------------------
 * Compile Single javascript & scss files
 * --------------------------------------------------------------------
 */
mix.js('app/Assets/scripts/main.js', 'scripts').version();
mix.sass('app/Assets/styles/main.scss', 'styles').version();

/*
 * --------------------------------------------------------------------
 * Compile javascript files
 * --------------------------------------------------------------------
 */
//Layouts
mix.js('app/Assets/scripts/layouts/main.js', 'scripts/layouts').version();

/*
 * --------------------------------------------------------------------
 * Compile scss files
 * --------------------------------------------------------------------
 */
//Layouts
mix.sass('app/Assets/styles/layouts/main.scss', 'styles/layouts').version();

/*
 * --------------------------------------------------------------------
 * Minify images
 * --------------------------------------------------------------------
 */

/*
mix.webpackConfig({
    plugins: [
        new CopyPlugin({
            patterns: [{ from: 'app/Assets/images', to: 'images' }],
        }),
        new ImageminPlugin({
            pngquant: {
                quality: '50',
            },
            test: /\.(jpe?g|png|gif|svg)$/i,
        }),
    ],
});
*/

/*
 * --------------------------------------------------------------------
 * Post Compilation Steps
 * --------------------------------------------------------------------
 */
mix.after(() => {
    console.log('Compilation complete');
});

/*
 * --------------------------------------------------------------------
 * Environment Specific Functionality
 * --------------------------------------------------------------------
 */
if (mix.inProduction()) {
    mix.disableNotifications();
    console.log('Add commands that are only required for production');
} else {
    console.log('Add commands that are only required for development');
}
