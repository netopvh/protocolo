let gulp = require('gulp');
let concat = require('gulp-concat');
let cleanCss = require('gulp-clean-css');
let uglify = require('gulp-uglify');
let less = require('gulp-less');
let rev = require('gulp-rev');
let rename = require('gulp-rename');

/**
 * CSS
 */

gulp.task('bootstrap-less', function () {
    return gulp.src([
        'resources/assets/less/_main_full/bootstrap.less'
    ])
        .pipe(less())
        .pipe(concat('bootstrap.min.css'))
        //.pipe(cleanCss())
        .pipe(gulp.dest('public/backend/css'))
});

gulp.task('core-less', function () {
    return gulp.src([
        'resources/assets/less/_main_full/core.less'
    ])
        .pipe(less())
        .pipe(concat('core.min.css'))
        //.pipe(cleanCss())
        .pipe(gulp.dest('public/backend/css'))
});

gulp.task('components-less', function () {
    return gulp.src([
        'resources/assets/less/_main_full/components.less'
    ])
        .pipe(less())
        .pipe(concat('components.min.css'))
        //.pipe(cleanCss())
        .pipe(gulp.dest('public/backend/css'))
});

gulp.task('colors-less', function () {
    return gulp.src([
        'resources/assets/less/_main_full/colors.less'
    ])
        .pipe(less())
        .pipe(concat('colors.min.css'))
        //.pipe(cleanCss())
        .pipe(gulp.dest('public/backend/css'))
});

gulp.task('icon-css', function () {
    return gulp.src([
        'resources/assets/css/icons/icomoon/styles.css'
    ])
        .pipe(rename("icoomon.min.css"))
        .pipe(cleanCss())
        .pipe(gulp.dest('./public/backend/css'));
});

/**
 * JAVASCRIPT
 */

gulp.task('core', function () {
    return gulp.src(['resources/assets/js/plugins/loaders/pace.min.js',
        'resources/assets/js/core/libraries/jquery.min.js',
        'resources/assets/js/core/libraries/bootstrap.min.js',
        'resources/assets/js/plugins/loaders/blockui.min.js'])
        .pipe(concat('js/core.js'))
        //.pipe(uglify())
        //.pipe(rev())
        .pipe(gulp.dest('public/backend'));
});

gulp.task('js-theme', function () {
    return gulp.src([
        'resources/assets/js/plugins/forms/styling/switchery.min.js',
        'resources/assets/js/plugins/forms/selects/select2.min.js',
        'resources/assets/js/plugins/pickers/pickadate/picker.js',
        'resources/assets/js/plugins/pickers/pickadate/picker.date.js',
        'resources/assets/js/plugins/pickers/pickadate/legacy.js',
        'resources/assets/js/plugins/forms/inputs/duallistbox.min.js',
        'resources/assets/js/plugins/notifications/sweet_alert.min.js',
        'resources/assets/js/plugins/notifications/bootbox.min.js',
        'resources/assets/js/plugins/forms/validation/validate.min.js',
        'resources/assets/js/plugins/forms/validation/additional_methods.min.js',
        'resources/assets/js/plugins/forms/validation/localization/messages_pt_BR.js',
        'resources/assets/js/plugins/forms/styling/uniform.min.js',
        'resources/assets/js/plugins/ui/moment/moment.min.js',
        'resources/assets/js/plugins/forms/mask/inputmask/dist/jquery.inputmask.bundle.js',
        'resources/assets/js/plugins/ui/nicescroll.min.js'])
        .pipe(concat('js/theme.js'))
        .pipe(uglify())
        .pipe(rev())
        .pipe(gulp.dest('public/backend'))
        .pipe(rev.manifest({
            path: 'mix-manifest.json',
            merge:true
        }))
        .pipe(gulp.dest('public/backend'))
});

gulp.task('js-app', function () {
    return gulp.src(['resources/assets/js/core/app.js',
        'resources/assets/js/pages/layout_fixed_custom.js',
        'resources/assets/js/plugins/ui/ripple.min.js'])
        .pipe(concat('backend/js/bundle.js'))
        .pipe(uglify())
        .pipe(rev())
        .pipe(gulp.dest('public'))
        .pipe(rev.manifest({
            path: 'mix-manifest.json',
            merge:true
        }))
        .pipe(gulp.dest('public'));
});

gulp.task('fonts', function () {
    return gulp.src([
        'resources/assets/css/icons/fontawesome/fonts/*',
        'resources/assets/css/icons/glyphicons/*',
        'resources/assets/css/icons/icomoon/fonts/*',
        'resources/assets/css/icons/summernote/*'
    ])
        .pipe(gulp.dest('./public/backend/fonts'));
});

gulp.task('images', function () {
    return gulp.src([
        'resources/assets/images/**/**'
    ])
        .pipe(gulp.dest('./public/backend/images'));
});


gulp.task('less', ['bootstrap-less', 'core-less', 'components-less', 'colors-less', 'icon-css']);

gulp.task('js', ['js-theme', 'js-app']);