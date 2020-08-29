const merge = require('webpack-merge')
const base = require('./webpack.base.js')
const path = require('path')
module.exports = merge(base, {
  mode: 'development',
  devtool: 'source-map',
  devServer: {
    hot: true,
    port: 9000
  }
})