let mix = require('laravel-mix')

require('./nova.mix')

mix
    .setPublicPath('dist')
    .js('resources/js/filter.js', 'js')
    .sass('resources/sass/filter.scss', 'css')
    .vue({ version: 3 })
    .nova('suenerds/nova-searchable-belongs-to-filter')
