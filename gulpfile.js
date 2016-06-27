var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

var sassPaths = [
    'bower_components/foundation-sites/scss',
    'bower_components/motion-ui/src',
    'bower_components/slick-carousel/slick',
];

var jsPaths = [
    'bower_components/slick-carousel/slick/slick.js',
    'bower_components/foundation-sites/dist/foundation.min.js',
    'assets/js/*.js',
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
        //.pipe($.sass())
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('./'))
        .pipe($.notify({ message: 'Sass task complete' }));
});

gulp.task('scripts', function() {
    return gulp.src(jsPaths)
        .pipe($.concat('script.js'))
        .pipe(gulp.dest('./'))
        .pipe($.rename({suffix: '.min'}))
        .pipe($.uglify())
        .pipe(gulp.dest('./'))
        .pipe($.notify({ message: 'Scripts task complete' }));
});

gulp.task('default', ['sass', 'scripts'], function () {
    gulp.watch(['assets/scss/**/*.scss'], ['sass']);
    gulp.watch(['assets/js/*.js'], ['scripts']);
});
