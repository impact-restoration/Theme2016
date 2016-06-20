var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

var sassPaths = [
    'bower_components/foundation-sites/scss',
    'bower_components/motion-ui/src'
];

gulp.task('sass', function () {
    return gulp.src('assets/scss/style.scss')
        .pipe($.sass({
                includePaths: sassPaths
            })
            .on('error', $.sass.logError))
        .pipe($.sourcemaps.init())
        .pipe($.autoprefixer({
            browsers: ['last 2 versions', 'ie >= 9']
        }))
        .pipe($.sass({outputStyle: 'compressed'}))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('./'));
});

gulp.task('default', ['sass'], function () {
    gulp.watch(['scss/**/*.scss'], ['sass']);
});
