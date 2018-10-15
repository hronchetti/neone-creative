let gulp = require('gulp');
let browserSync = require('browser-sync').create();
let sass = require('gulp-sass');
let sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
htmlv = require('gulp-html-validator');

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function () {
    return gulp.src("public/libs/sass/main.scss")
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sass(sass).on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest("public/libs/css"))
        .pipe(browserSync.stream());
});


// Browser auto prefixing
gulp.task('autoprefix', () =>
gulp.src('public/libs/css/main.css')
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('public/libs/css'))
);


// HTML5 Validator
gulp.task('validate', function () {
    gulp.src('*.html')
        .pipe(htmlv({format: 'html'}))
        .pipe(gulp.dest('htmlValidator'));
});

// Static Server + watching scss/html files + auto prefixing
gulp.task('serve', ['sass'], function () {

    browserSync.init({
        startPath: "public/index.html",
        server: "./"
    });

    gulp.watch("public/libs/sass/main.scss", ['sass']);
    gulp.watch("public/libs/sass/**/*.scss", ['sass']);
    gulp.watch("public/libs/css/main.css", ['autoprefix']);
    gulp.watch("public/*.html").on('change', browserSync.reload);
});