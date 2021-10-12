const path = require('path');
const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const WebpackBar = require('webpackbar');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');

const projectOutputPath = '../Resources/Public/';
const projectResourcePath = 'Assets/';

module.exports = {
  entry: {
    app: [
      path.resolve(__dirname, projectResourcePath) + '/JavaScript/app.js',
      path.resolve(__dirname, projectResourcePath) + '/Sass/app.scss'
    ],
    rte: [
      path.resolve(__dirname, projectResourcePath) + '/Sass/rte.scss'
    ]
  },
  output: {
    path: path.resolve(__dirname, projectOutputPath),
    filename: 'JavaScript/[name].min.js'
  },
  optimization: {
    minimizer: [new UglifyJsPlugin()]
  },
  plugins: [
    new webpack.ProgressPlugin(),
    new WebpackBar({
      clear: false,
      profile: true,
    }),
    new FriendlyErrorsWebpackPlugin(),
    new CopyPlugin([
      {
        from: path.resolve(__dirname, projectResourcePath) + '/Images',
        to: 'Images',
        cache: true
      }
    ]),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      isotope: 'isotope-layout'
    }),
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // both options are optional
      filename: 'Css/[name].min.css',
      chunkFilename: 'Css/[name].min.css'
    }),
    new StyleLintPlugin({
      configFile: 'Build/.stylelintrc',
      syntax: 'scss',
      files: '**/*.scss',
      quiet: false,
      emitError: true,
      emitWarning: true,
      failOnError: false,
      failOnWarning: false,
    }),
  ],
  module: {
    rules: [
      {
        enforce: "pre",
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "eslint-loader",
        options: {
          sourceMap: true,
          cache: false,
          configFile: 'Build/.eslintrc.js',
          emitError: true,
          emitWarning: true,
          failOnError: false,
          failOnWarning: false,
        }
      },
      {
        test: /\.m?js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.(woff|woff2|eot|ttf)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              publicPath: '../Fonts',
              outputPath: 'Fonts'
            }
          }
        ]
      },
      {
        test: /\.(jpe?g|png|svg|gif)$/,
        use: [
          'url-loader?limit=100000'
        ]
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            }
          },
          {
            loader: 'resolve-url-loader',
            options: {
              sourceMap: true
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              autoprefixer: {
                browsers: ["> 5%"]
              },
              sourceMap: true,
              plugins: [
                require('autoprefixer'),
                require('cssnano')
              ],
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
            }
          }
        ]
      }
    ]
  }
};
