const BuildNotifierPlugin = require('webpack-build-notifier');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { removeEmpty } = require('webpack-config-utils');
const { merge } = require('webpack-merge');

const common = require('./webpack.common');

const { DIR, DEV, PLUGINS, OPTIONS, STATS, isDevelopment } = require('./settings');

module.exports = merge(common, {
    mode: 'development',

    // Control how source maps are generated
    devtool: isDevelopment ? DEV.useSourceMap && DEV.typeSourceMap : false,

    stats: DEV.showStats ? STATS : 'errors-only',

    module: {
        rules: [
            // Styles: Inject CSS into the head with source maps
            {
                test: /\.(scss|css)$/,
                use: [
                    'style-loader',
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: { sourceMap: DEV.useSourceMap, importLoaders: 1, modules: false },
                    },
                    { loader: 'postcss-loader', options: { sourceMap: DEV.useSourceMap } },
                    { loader: 'sass-loader', options: { sourceMap: DEV.useSourceMap } },
                ],
            },
        ],
    },

    plugins: removeEmpty([
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: 'Css/[name].min.css',
            chunkFilename: 'Css/[name].min.css',
        }),
        // https://www.npmjs.com/package/webpack-build-notifier
        (PLUGINS.notifier ? true : undefined) &&
            isDevelopment &&
            new BuildNotifierPlugin(OPTIONS.notifier('Development', 'icon.png', 'Submarine')),
    ]),

    // Spin up a server for quick development
    devServer: {
        historyApiFallback: true,
        static: DIR.public,
        open: true,
        compress: true,
        hot: true,
        host: DEV.host,
        port: DEV.port,
    },
});
