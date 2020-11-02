
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
//var reload = browserSync.reload;
//
//
//// Static server
//gulp.task('browser-sync', function() {
//    browserSync.init({
//        /*server: {
//            baseDir: "./"
//        }*/
//    	proxy: 'http://localhost/Payal_Priyadarshini_PHP_Project_Template/'
//    });

        gulp.task('browser-sync', function()
            {
                browserSync.init({
                proxy: "http://localhost/Payal_Priyadarshini_PHP_Project_Template/"
            });
        });
      
        gulp.watch("index.html").on('change', browserSync.reload);
//});

