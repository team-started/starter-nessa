const merge = require('webpack-merge');
const baseConfig = require('./webpack.common.js');

const developConfig = {
  mode: 'development',
  devtool: "source-map"
};

module.exports = merge.smart(baseConfig, developConfig);
