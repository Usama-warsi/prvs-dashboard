const mix = require('laravel-mix');
const path = require('path');

const directory = path.basename(path.resolve(__dirname));
const source = `platform/plugins/${directory}`;
const dist = `public/vendor/core/plugins/${directory}`;

mix
    .sass(`${source}/resources/sass/tenant.scss`, `${dist}/css`)
    .js(`${source}/resources/js/tenant.js`, `${dist}/js`)
    .copyDirectory(`${dist}/css`, `${source}/public/css`)
    .copyDirectory(`${dist}/js`, `${source}/public/js`);
