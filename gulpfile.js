const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');

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
        gulp.series(['clean', 'styles'])(done);
    });
});