const gulp = require('gulp');
const log = require('fancy-log');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');
const terser = require('gulp-terser');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const vinylSourceStream = require('vinyl-source-stream');
const browserify = require('browserify');
const babelify = require('babelify');

// src paths
var cssSrcPath = './resources/src/scss';
var jsSrcPath = './resources/src/js';

// dist paths
var cssDistPath = './public/css';
var jsDistPath = './public/js';

// CSS
var styles = [
  {
    name: 'main',
    src: [cssSrcPath + '/frontend/main.scss'],
    srcWatch: [cssSrcPath + '/frontend/**/*.scss'],
    dest: cssDistPath
  },
  {
    name: 'admin',
    src: [cssSrcPath + '/backend/admin.scss'],
    srcWatch: [cssSrcPath + '/backend/**/*.scss'],
    dest: cssDistPath
  }
];

// JavaScript
var scripts = [
  {
    name: 'main',
    src: [jsSrcPath + '/frontend/main.js'],
    srcWatch: [jsSrcPath + '/frontend/**/*.js'],
    dest: jsDistPath
  },
  {
    name: 'admin',
    src: [jsSrcPath + '/backend/admin.js'],
    srcWatch: [jsSrcPath + '/backend/**/*.js'],
    dest: jsDistPath
  }
];

// Tasks
let defaultTasks = [];
let watchTasks = [];
let buildTasks = [];

// Config CSS task
for (const style of styles) {
  const cssTaskConcat = function () {
    return gulp
      .src(style.src)
      .pipe(sourcemaps.init())
      .pipe(
        sass({
          outputStyle: 'expanded'
        }).on('error', sass.logError)
      )
      .pipe(concat(style.name + '.css'))
      .pipe(sourcemaps.write('./'))
      .pipe(gulp.dest(style.dest));
  };

  // Store as a task
  gulp.task('cssTaskConcat-' + style.name, cssTaskConcat);

  // Add to default tasks
  defaultTasks.push('cssTaskConcat-' + style.name);

  // Add to watch tasks
  watchTasks.push({
    src: style.srcWatch || style.src,
    task: cssTaskConcat
  });

  const cssTaskMinify = function () {
    return gulp
      .src(style.dest + '/' + style.name + '.css')
      .pipe(rename(style.name + '.min.css'))
      .pipe(cleanCSS())
      .pipe(gulp.dest(style.dest));
  };

  // Store as a task
  gulp.task('cssTaskMinify-' + style.name, cssTaskMinify);

  // Add to build tasks
  buildTasks.push('cssTaskMinify-' + style.name);
}

// Config JavaScript task
for (const script of scripts) {
  const jsTaskConcat = function () {
    return browserify({
      entries: script.src,
      debug: true
    })
      .transform(babelify, { presets: ['@babel/preset-env'] })
      .bundle()
      .on('error', function (e) {
        log(e);
      })
      .pipe(vinylSourceStream(script.name + '.js'))
      .pipe(gulp.dest(script.dest));
  };

  // Store as a task
  gulp.task('jsTaskConcat-' + script.name, jsTaskConcat);

  // Add to default tasks
  defaultTasks.push('jsTaskConcat-' + script.name);

  // Add to watch tasks
  watchTasks.push({
    src: script.srcWatch || script.src,
    task: jsTaskConcat
  });

  // Minify
  const jsTaskMinify = function () {
    return gulp
      .src(script.dest + '/' + script.name + '.js')
      .pipe(terser())
      .pipe(rename(script.name + '.min.js'))
      .pipe(gulp.dest(script.dest));
  };

  // Store as a task
  gulp.task('jsTaskMinify-' + script.name, jsTaskMinify);

  // Add to build tasks
  buildTasks.push('jsTaskMinify-' + script.name);
}

// Watch tasks
function watch() {
  for (const watchTask of watchTasks) {
    gulp.watch(watchTask.src, watchTask.task);
  }
}

// Exports
exports.default = gulp.series(defaultTasks);
exports.watch = gulp.series(defaultTasks, watch);
exports.build = gulp.series(defaultTasks, buildTasks);
