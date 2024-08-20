const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const cssmin = require('gulp-cssmin')
const autoprefixer = require('gulp-autoprefixer')
const rename = require('gulp-rename')
const plumber = require('gulp-plumber')
const browserSync = require('browser-sync').create()
var sourcemaps = require('gulp-sourcemaps')
var fs = require('fs');
var path = require('path');
var merge = require('merge-stream');
var blockStylesPath = './blocks/';

function getFolders(dir) {
  return fs.readdirSync(dir)
    .filter(function(file) {
      return fs.statSync(path.resolve(dir, file)).isDirectory();
    });
}

const source = {
  style: './assets/scss/**/*.scss',

  mainsass: './assets/scss/main.scss',

  minsass: './assets/css/main.min.css',
  allbuild: './dist/**/',
  build: './dist/'
}

const destination = {
  style: './assets/css/'
}


//Task is to compile sass code to css files
gulp.task('sass', done => {
  return gulp.src(source.mainsass)
  .pipe(sourcemaps.init())
  .pipe(plumber())
  .pipe(sass())
  .pipe(autoprefixer({
    browsers: ['last 2 versions', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'],
    cascade: false
  }))
  .pipe(cssmin())
  .pipe(rename({suffix: '.min'}))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(destination.style))
  .pipe(browserSync.reload({
    stream: true
  }))

  done => done()
})

//Blocks' minified css
gulp.task('minblocksass', function() {
  var folders = getFolders(blockStylesPath);

  var tasks = folders.map(function(folder) {
    var dst = path.resolve(blockStylesPath, folder);
     return gulp.src(path.resolve(blockStylesPath, folder, 'style.scss'), { allowEmpty: true })
      .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(sass())
      .pipe(autoprefixer({
        browsers: ['last 2 versions', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'],
        cascade: false
      }))
      .pipe(cssmin())
      .pipe(rename({suffix: '.min'}))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(dst))
      .pipe(browserSync.reload({
        stream: true
      }))
  });

  return merge(tasks);
});

//Task is for the auto reload of the page every time the developer saves their work
gulp.task('watch', done => {
  gulp.watch(source.style, gulp.series('sass'))
  gulp.watch('./blocks/**/style.scss', gulp.series('minblocksass'))
  done => done()
})

//This task is to open the project into the browser
//and can access by all the device with the same network
gulp.task('browserSync', () => {
  browserSync.init({
    server: {
      baseDir: './'
    },
  })
})


//Run this task when your developing
gulp.task('default', gulp.series(
  gulp.parallel(
    'sass',
    'minblocksass',
    'browserSync',
    'watch')
), done => done()
)


/////////////////////////
///////Build Task////////
/////////////////////////


//Task is to compile sass to css and minify the css file
gulp.task('minsass', done => {
  return gulp.src(source.mainsass)
  .pipe(plumber())
  .pipe(sass())
  .pipe(autoprefixer({
    browsers: ['last 2 versions', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'],
    cascade: false
  }))
  .pipe(cssmin())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('./dist/css/'))

  done => done()
})


//This task opens browser sync for built project
gulp.task('build:browserSync', () => {
  browserSync.init({
    server: {
      baseDir: './dist'
    },
  })
})


//Run this task for building project
gulp.task('build', gulp.series(
  // 'build:clear',
  'minsass',
  'minblocksass',
  'build:browserSync'
),done => done()
)
