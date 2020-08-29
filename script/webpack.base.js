const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const VueLoaderPlugin = require('vue-loader/lib/plugin')
module.exports = {
  entry: path.resolve(__dirname, '../', './src/index.js'),
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, '../', './dist')
  },
  plugins: [
    new CleanWebpackPlugin(),
    new HtmlWebpackPlugin({
      title: '竹影流浪',
      template: path.resolve(__dirname, '../', 'public', 'index.html')
    }),
    new VueLoaderPlugin()
  ],
  module: {
    rules: [{
      test: /\.vue$/,
      loader: 'vue-loader'
    }]
  }
}