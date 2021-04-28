const gulp = require('gulp')
const { series, watch } = require('gulp')
const inject = require('gulp-inject')
const clean = require('gulp-clean')
const postcss = require('gulp-postcss')
const sass = require('gulp-sass')
const csso = require('gulp-csso')

function cleanDist() {
  // 清理dist文件夹
  return gulp.src('./dist/*', { read: false }).pipe(clean())
}

function buildCSS() {
  // 构建CSS
  let tailwindcss = require('tailwindcss')
  return gulp
    .src(['./src/css/main.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([tailwindcss('./tailwind.config.js'), require('autoprefixer')]))
    .pipe(csso())
    .pipe(gulp.dest('./dist/css/'))
}

function injectCSS() {
  // 注入CSS
  let target = gulp.src('./src/template/index.php')
  let sources = gulp.src('./dist/css/main.css')
  return target
    .pipe(
      inject(sources, {
        starttag: '<!-- inject:css -->',
        transform: function (path) {
          return `<link rel="stylesheet" href="<?php $this->options->themeUrl('${path.split('/dist')[1]}'); ?>">`
        },
      })
    )
    .pipe(gulp.dest('./dist'))
}
if (process.env.NODE_ENV === 'production') {
  exports.default = series(cleanDist, buildCSS, injectCSS)
} else if (process.env.NODE_ENV === 'development') {
  watch('./src/**/*.scss', buildCSS)
  watch('./src/**/*.php', injectCSS)
  exports.default = series(cleanDist, buildCSS, injectCSS)
}
