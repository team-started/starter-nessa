const webpack = require('webpack');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const { removeEmpty } = require('webpack-config-utils');
const { merge } = require('webpack-merge');

const common = require('./webpack.common');

const { BUILD, STATS, isProduction } = require('./settings');

module.exports = merge(common, {
    mode: 'production',

    devtool: BUILD.useSourceMap ? BUILD.typeSourceMap : false,

    output: {
        publicPath: '../',
        path: BUILD.dist,
        filename: BUILD.hashJs
            ? `${BUILD.jsFolder}/[name].[hash].min.js`
            : `${BUILD.jsFolder}/[name].min.js`,
        chunkFilename: BUILD.hashJs
            ? `${BUILD.jsFolder}/[name].[hash].min.js`
            : `${BUILD.jsFolder}/[name].min.js`,
    },

    stats: BUILD.showStats ? STATS : 'errors-only',

    module: {
        rules: [
            {
                test: /\.(scss|css)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: BUILD.useSourceMap,
                            importLoaders: 2,
                            modules: false,
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: { sourceMap: BUILD.useSourceMap },
                    },
                    { loader: 'sass-loader', options: { sourceMap: BUILD.useSourceMap } },
                ],
            },
        ],
    },

    plugins: removeEmpty([
        new webpack.BannerPlugin({
            banner: BUILD.banner,
        }),

        // Extracts CSS into separate files
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: BUILD.hashCss
                ? `${BUILD.cssFolder}/[name].[hash].min.css`
                : `${BUILD.cssFolder}/[name].min.css`,
            chunkFilename: BUILD.hashCss
                ? `${BUILD.cssFolder}/[name].[hash].min.css`
                : `${BUILD.cssFolder}/[name].min.css`,
        }),

        (BUILD.buildManifest ? true : undefined) && new WebpackManifestPlugin(),
    ]),

    // https://webpack.js.org/configuration/optimization/
    optimization: {
        minimize: true,
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin({
                // https://github.com/webpack-contrib/terser-webpack-plugin#terseroptions
                extractComments: false,
                terserOptions: {
                    ecma: 2018,
                    compress: {
                        // warnings: false,
                        // drop_console: false,
                        // drop_debugger: true,
                        // filter all console's statements for release
                        // console.error, console.warn will stay
                        pure_funcs: isProduction
                            ? [
                                  'console.group',
                                  'console.groupEnd',
                                  'console.time',
                                  'console.timeEnd',
                                  'console.info',
                                  'console.debug',
                                  'console.dir',
                                  'console.log',
                              ]
                            : [],
                    },
                    output: {
                        comments: false,
                        preamble: BUILD.banner,
                    },
                },
            }),
            // '...', // can be used in optimization.minimizer to access the defaults.
        ],
        runtimeChunk: {
            name: 'runtime',
        },
    },

    performance: {
        hints: false,
        maxEntrypointSize: 512000,
        maxAssetSize: 512000,
    },
});
