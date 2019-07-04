// --------------------------------------------
// Dependencies
// --------------------------------------------
var autoprefixer = require('gulp-autoprefixer'),
  concat = require('gulp-concat'),
  del = require('del'),
  gulp = require('gulp'),
  minifycss = require('gulp-minify-css'),
  plumber = require('gulp-plumber'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  rename = require('gulp-rename'),
  uglify = require('gulp-uglify'),
  images = require('gulp-imagemin'),
  browserSync = require('browser-sync').create(),
  imagemin = require('gulp-imagemin'),
  babel = require('gulp-babel'),
  swPrecache = require('sw-precache'),
  jquery = require('jquery');


// paths
var styleSrc = 'content/themes/anna/src/sass/**/*.sass',
  styleDest = 'content/themes/anna/',
  htmlSrc = 'content/themes/anna/src/',
  htmlDest = 'content/themes/anna/',
  vendorSrc = 'content/themes/anna/src/js/vendors/',
  vendorDest = 'content/themes/anna/js/',
  scriptSrc = 'content/themes/anna/src/js/*.js',
  scriptDest = 'content/themes/anna/js/';




// --------------------------------------------
// Stand Alone Tasks
// --------------------------------------------





// Compiles all SASS files


gulp.task('sass', function () {
  return gulp
    .src(styleSrc)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
  
    .pipe(minifycss())
    .pipe(autoprefixer('last 2 versions'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(styleDest));
});





gulp.task('images', function () {
  gulp.src('content/themes/anna/src/img/**/*')
    .pipe(images())
    .pipe(imagemin())
    .pipe(gulp.dest('img'));
});

// Uglify js files
gulp.task('scripts', function () {
  gulp.src('content/themes/anna/src/js/*.js')
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(babel({
      "presets": ["env"]
    }))
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(scriptDest));
});

// //Concat and Compress Vendor .js files
// gulp.task('vendors', function () {
//   gulp.src(
//     [
//       'node_modules/jquery/dist/jquery.js',
//       'node_modules/rangeslider.js/dist/rangeslider.js',
//       'content/themes/anna/src/js/vendors/*.js'
//     ])
//     .pipe(plumber())
//     .pipe(concat('vendors.min.js'))
//     .pipe(uglify())
//     .pipe(gulp.dest('js'));
// });




// Watch for changes
gulp.task('watch', function () {

  // Serve files from the root of this project
  browserSync.init({

   proxy: 'anna-wp.digital'


  });

  gulp.watch(styleSrc, ['sass']);
  gulp.watch(styleSrc, ['images']);
  gulp.watch(scriptSrc, ['scripts']);
  gulp.watch(vendorSrc, ['vendors']);
  gulp.watch([
    '**/*.php', 
    'content/themes/anna/*.css',
    'content/themes/anna/css/*.css',
    'content/themes/anna/js/*.js',
    'content/themes/anna/src/sass/*.sass',
    'content/themes/anna/src/sass/**/*.sass',
    'content/themes/anna/js/vendors/*.js'
  ]).on('change', browserSync.reload);

});


// use default task to launch Browsersync and watch JS files
gulp.task('default', ['sass', 'scripts', 'watch', 'images'], function () { });