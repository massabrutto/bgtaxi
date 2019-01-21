'use strict';

var gulp = require('gulp'),
  jade = require('gulp-jade'),
  prefixer = require('gulp-autoprefixer'),
  plumber = require('gulp-plumber'),
  uglify = require('gulp-uglify'),
  cssmin = require('gulp-minify-css'),
  sass = require('gulp-sass'),
  imagemin = require('gulp-imagemin'),
  pngquant = require('imagemin-pngquant'),
  sourcemaps = require('gulp-sourcemaps'),
  browserSync = require('browser-sync').create(),
  reload = browserSync.reload;

var path = {
  build: {
    html: 'themes/bgtaxi/html',
    js: 'themes/bgtaxi/assets/js',
    jslibs: 'themes/bgtaxi/assets/js/libs',
    css: 'themes/bgtaxi/assets/css',
    img: 'themes/bgtaxi/img',
  },
  src: {
    jade: 'src/*.jade',
    js: 'src/js/main.js',
    jslibs: 'src/js/libs/*.js',
    style: 'src/style/main.scss',
    img: 'src/img/**/*.*',
  },
  watch: {
    jade: 'src/**/*.jade',
    js: 'src/js/**/*.js',
    style: 'src/style/**/*.scss',
    img: 'src/img/**/*.*',
  },
};

var config = {
  server: './build',
  directory: true,
  open: false,
  reloadOnRestart: false,
  ghostMode: false,
};

gulp.task('html:build', function() {
  gulp
    .src(path.src.jade)
    .pipe(plumber())
    .pipe(
      jade({
        pretty: true,
      })
    )
    .pipe(gulp.dest(path.build.html))
    .pipe(reload({ stream: true }));
});

gulp.task('js:build', function() {
  gulp
    .src(path.src.js)
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest(path.build.js))
    .pipe(reload({ stream: true }));
});

gulp.task('jslibs:build', function() {
  gulp
    .src(path.src.jslibs)
    .pipe(plumber())
    .pipe(gulp.dest(path.build.jslibs));
});

gulp.task('style:build', function() {
  gulp
    .src(path.src.style)
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(sass())
    .pipe(prefixer())
    .pipe(cssmin())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(path.build.css))
    .pipe(reload({ stream: true }));
});

gulp.task('image:build', function() {
  gulp
    .src(path.src.img)
    .pipe(plumber())
    .pipe(
      imagemin({
        progressive: true,
        svgoPlugins: [{ removeViewBox: false }],
        use: [pngquant()],
        interlaced: true,
      })
    )
    .pipe(gulp.dest(path.build.img))
    .pipe(reload({ stream: true }));
});

gulp.task('build', [
  'html:build',
  'js:build',
  'jslibs:build',
  'style:build',
  'image:build',
]);

gulp.task('watch', function() {
  gulp.watch(path.watch.jade, ['html:build']);
  gulp.watch(path.watch.style, ['style:build']);
  gulp.watch(path.watch.js, ['js:build']);
  gulp.watch(path.watch.js, ['jslibs:build']);
  gulp.watch(path.watch.img, ['image:build']);
});

gulp.task('webserver', function() {
  browserSync.init(config);
});

gulp.task('default', ['build', 'webserver', 'watch']);
