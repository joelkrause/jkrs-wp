var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var pipeline = require('readable-stream').pipeline;

// This compiles the sass files into one
gulp.task('compile', () => {
    return gulp.src('lib/styles/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('lib/styles/css/'));
});

// This prefixes the compiled sass file
gulp.task('prefix', () =>
    gulp.src('lib/styles/css/main.css')
    .pipe(autoprefixer({
        overrideBrowserslist: ['last 99 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('lib/styles/css'))
);

// This minifies the compiled/prefixed css file
gulp.task('minify-styles', () => {
    return gulp.src('lib/styles/css/main.css')
        .pipe(cleanCSS({
            compatibility: 'ie8'
        }))
        .pipe(gulp.dest('lib/styles/css'));
});

// This merges all scripts that are in the src folder into a new file called scripts.min.js
gulp.task('merge-scripts', function () {
    return gulp.src(['lib/scripts/src/*.js','lib/scripts/scripts.js'])
        .pipe(concat({
            path: 'scripts.min.js'
        }))
        .pipe(gulp.dest('lib/scripts'));
});

// This compresses the new scripts.min.js file
gulp.task('compress-scripts', function () {
    return pipeline(
        gulp.src('lib/scripts/scripts.min.js'),
        uglify(),
        gulp.dest('lib/scripts')
    );
});

// This is the "major" gulp task that watches sass and js files and runs tasks accordingly!
// I am also excluding the new scripts.min.js file from the watch because it caused an inifnite loop of merging/compressing lol
gulp.task('watch', () => {
    gulp.watch('lib/styles/scss/**/*.scss', (done) => {
        gulp.series(['compile', 'prefix', 'minify-styles', 'merge-scripts', 'compress-scripts'])(done);
    });
    gulp.watch(['lib/scripts/**/*.js','!lib/scripts/scripts.min.js'], (done) => {
        gulp.series(['merge-scripts', 'compress-scripts'])(done);
    });
});