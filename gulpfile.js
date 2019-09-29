const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const del = require('del');

gulp.task('prefix', () =>
    gulp.src('lib/styles/css/main.css')
    .pipe(autoprefixer({
        overrideBrowserslist: ['last 99 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('lib/styles/css'))
);

gulp.task('styles', () => {
    return gulp.src('lib/styles/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('lib/styles/css/'));
});

gulp.task('clean', () => {
    return del([
        'css/main.css',
    ]);
});

gulp.task('default', gulp.series(['clean', 'styles']));

gulp.task('watch', () => {
    gulp.watch('lib/styles/scss/**/*.scss', (done) => {
        gulp.series(['clean', 'styles', 'prefix'])(done);
    });
});