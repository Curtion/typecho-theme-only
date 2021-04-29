const gulp = require('gulp')
const { series, watch } = require('gulp')
const inject = require('gulp-inject')
const clean = require('gulp-clean')
const postcss = require('gulp-postcss')
const csso = require('gulp-csso')

function cleanDist() {
  // 清理dist文件夹
  return gulp.src('./src/dist/*', { read: false }).pipe(clean())
}

function dev() {
  // 开发模式
  watch(['./src/**/*.css', '!./src/dist/**/*'], buildCSS)
  watch(['./src/**/index.php', '!./src/dist/**/*'], injectCSS)
}

function buildCSS() {
  // 构建CSS
  let tailwindcss = require('tailwindcss')
  return gulp
    .src(['./src/css/base.css'])
    .pipe(postcss([tailwindcss('./tailwind.config.js'), require('autoprefixer'), require('postcss-import')]))
    .pipe(csso())
    .pipe(gulp.dest('./src/dist/css/'))
}

function injectCSS() {
  // 注入CSS
  let target = gulp.src('./src/template/index.php')
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
}

function buildJS() {
  // 构建JS
  let tailwindcss = require('tailwindcss')
  return gulp
    .src(['./src/css/base.css'])
    .pipe(postcss([tailwindcss('./tailwind.config.js'), require('autoprefixer'), require('postcss-import')]))
    .pipe(csso())
    .pipe(gulp.dest('./src/dist/css/'))
}

function injectJS() {
  // 注入JS
  let target = gulp.src('./src/template/index.php')
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
}

function copyFile() {
  // 拷贝文件
  return gulp.src(['./src/template/*', '!./src/template/index.php']).pipe(gulp.dest('./src/dist'))
}

if (process.env.NODE_ENV === 'production') {
  exports.default = series(cleanDist, buildCSS, injectCSS, buildJS, injectJS, copyFile)
} else if (process.env.NODE_ENV === 'development') {
  dev()
  exports.default = series(cleanDist, buildCSS, injectCSS, buildJS, injectJS, copyFile)
}
