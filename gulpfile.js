const gulp = require('gulp')
const { series, watch, parallel } = require('gulp')
const inject = require('gulp-inject')
const clean = require('gulp-clean')
const postcss = require('gulp-postcss')
const csso = require('gulp-csso')
const rollup = require('rollup')
const { nodeResolve } = require('@rollup/plugin-node-resolve')
const commonjs = require('@rollup/plugin-commonjs')
const json = require('@rollup/plugin-json')
const builtins = require('rollup-plugin-node-builtins')
const { terser } = require('rollup-plugin-terser')
const { babel } = require('@rollup/plugin-babel')
const livereload = require('gulp-livereload')

function dev(cb) {
  // 开发模式
  livereload.listen()
  watch(['./src/**/*.css', '!./src/dist/**/*'], buildCSS)
  watch(['./src/template/header.php'], injectCSS)
  watch(['./src/**/*.js', '!./src/dist/**/*'], buildJS)
  watch(['./src/template/footer.php'], injectJS)
  watch(['./src/**/*.php', '!./src/template/header.php', '!./src/template/footer.php', '!./src/dist/**/*'], copyPHP)
  cb()
}

function cleanDist() {
  // 清理dist文件夹
  return gulp.src('./src/dist/*', { read: false }).pipe(clean())
}

function buildCSS() {
  // 构建CSS
  let tailwindcss = require('tailwindcss')
  return gulp
    .src(['./src/css/base.css'])
    .pipe(postcss([tailwindcss('./tailwind.config.js'), require('postcss-import')], require('autoprefixer')))
    .pipe(csso())
    .pipe(gulp.dest('./src/dist/css/'))
    .pipe(livereload())
}

function injectCSS() {
  // 注入CSS
  let target = gulp.src('./src/template/header.php')
  let sources = gulp.src('./src/dist/css/base.css')
  return target
    .pipe(
      inject(sources, {
        starttag: '<!-- inject:css -->',
        transform: function (path) {
          let CSSPath = path.split('/dist')[1]
          return `<link rel="stylesheet" href="<?php $this->options->themeUrl('${CSSPath}'); ?>">`
        },
      })
    )
    .pipe(gulp.dest('./src/dist'))
    .pipe(livereload())
}

async function buildJS(cb) {
  // 构建JS
  const bundle = await rollup.rollup({
    input: './src/index.js',
    plugins: [json(), builtins(), nodeResolve(), commonjs(), babel({ babelHelpers: 'runtime', exclude: 'node_modules/**' }), terser()],
  })
  await bundle.write({
    file: './src/dist/js/index.js',
    format: 'cjs',
    sourcemap: process.env.NODE_ENV === 'production' ? false : true,
  })
  livereload.reload()
}

function injectJS() {
  // 注入JS
  let target = gulp.src('./src/template/footer.php')
  let sources = gulp.src('./src/dist/js/index.js')
  return target
    .pipe(
      inject(sources, {
        starttag: '<!-- inject:js -->',
        transform: function (path) {
          let JSPath = path.split('/dist')[1]
          return `<script src="<?php $this->options->themeUrl('${JSPath}'); ?>"></script>`
        },
      })
    )
    .pipe(gulp.dest('./src/dist'))
    .pipe(livereload())
}

function copyPHP() {
  // 拷贝php文件
  return gulp.src(['./src/template/*', '!./src/template/header.php', '!./src/template/footer.php']).pipe(gulp.dest('./src/dist')).pipe(livereload())
}

// 拷贝其它文件
function awesome() {
  return gulp.src(['./src/css/font-awesome-4.7.0/fonts/**/*']).pipe(gulp.dest('./src/dist/fonts'))
}

if (process.env.NODE_ENV === 'production') {
  exports.default = series(cleanDist, buildCSS, injectCSS, buildJS, injectJS, copyPHP, parallel(awesome))
} else if (process.env.NODE_ENV === 'development') {
  exports.default = series(cleanDist, buildCSS, injectCSS, buildJS, injectJS, copyPHP, parallel(awesome), dev)
}
