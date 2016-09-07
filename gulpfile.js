var elixir = require('laravel-elixir');
var gulp     = require('gulp');
var minify   = require('gulp-minify');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
 var paths = {
   assets: [],
   sass: [],
   javascript: [
     'resourcesss/assets/js/Controllers/AppController.js',
   ]

 };

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts([
      'Controllers/**.js',
      'Services/**.js',
      'app.js'
    ],'public/js/app.js');

    mix.version(['css/app.css','js/app.js']);

    mix.copy('bower_components/angular-material/angular-material.min.css', 'public/css/');
    mix.copy('bower_components/angular-material/angular-material.layouts.min.css', 'public/css/');

    mix.copy('bower_components/jquery/dist/jquery.min.js', 'public/js/');
    mix.copy('bower_components/angular/angular.min.js', 'public/js/');
    mix.copy('bower_components/angular-material/angular-material.min.js', 'public/js/');
    mix.copy('bower_components/angular-animate/angular-animate.min.js', 'public/js/');
    mix.copy('bower_components/angular-aria/angular-aria.min.js', 'public/js/');
    mix.copy('bower_components/angular-messages/angular-messages.min.js', 'public/js/');
    mix.copy('bower_components/angular-route/angular-route.min.js', 'public/js/');

    mix.copy('bower_components/foundation-sites/js/foundation.accordion.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.core.js', 'public/js/');

    mix.copy('bower_components/foundation-sites/js/foundation.util.keyboard.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.util.mediaQuery.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.util.motion.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.util.nest.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.util.touch.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.util.box.js', 'public/js/');

    mix.copy('bower_components/foundation-sites/js/foundation.accordionMenu.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.dropdown.js', 'public/js/');
    mix.copy('bower_components/foundation-sites/js/foundation.dropdownMenu.js', 'public/js/');

    mix.copy('bower_components/moment/min/moment.min.js', 'public/js/');
    mix.copy('bower_components/angular-datepicker/dist/angular-datepicker.min.js', 'public/js/');


    mix.copy('node_modules/motion-ui/dist/motion-ui.min.js', 'public/js/');

});
