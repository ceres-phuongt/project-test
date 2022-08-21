let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'packages/backends/' + directory;
const dist = 'public/vendor/backends/' + directory;

mix
    .js(source + '/resources/assets/js/script.js', dist + '/js')
    .sass(source + '/resources/assets/sass/style.scss', dist + '/css')

    .copyDirectory(source + '/public', dist)
    .copyDirectory(dist + '/js', source + '/public/js')
    .copyDirectory(dist + '/css', source + '/public/css');
