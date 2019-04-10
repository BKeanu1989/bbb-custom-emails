'use strict';

var gulp = require('gulp');

var wpPot = require('gulp-wp-pot');

gulp.task('pot', function () {
    return gulp.src('./**/*.php')
        .pipe(wpPot( {
            domain: 'bbb-custom-emails',
            package: 'StoreFront Child'
        } ))
        .pipe(gulp.dest('./languages/bbb-custom-emails.pot'));
});