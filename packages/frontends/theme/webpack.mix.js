let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'packages/frontends/' + directory;
const dist = 'public/vendor/frontends/' + directory;

mix
    .js(source + '/resources/assets/js/script.js', dist + '/js')
    .sass(source + '/resources/assets/sass/style.scss', dist + '/js')
    .copyDirectory(source + '/public', dist)
    .copyDirectory(dist + '/js', source + '/public/js')
    .copyDirectory(dist + '/css', source + '/public/css');

