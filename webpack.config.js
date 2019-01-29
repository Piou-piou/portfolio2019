var Encore = require('@symfony/webpack-encore');

Encore
.setOutputPath('public/build/')
.setPublicPath('/build')

.addStyleEntry('css/style', './assets/scss/style.scss')

.addEntry('js/index', './assets/js/index.js')

.createSharedEntry('vendor', './webpack.shared_entry.js')

.cleanupOutputBeforeBuild()
.enableSourceMaps(!Encore.isProduction())
.enableVersioning(Encore.isProduction())

// enables Sass/SCSS support
.enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
