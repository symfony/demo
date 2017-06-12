var Encore = require('@weaverryan/webpack-remix');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .setManifestKeyPrefix('build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .enableSassLoader()
    .enableVersioning(false)
    .addEntry('js/app', './app/Resources/assets/js/app.js')
    .addEntry('js/admin', './app/Resources/assets/js/admin.js')
    .addStyleEntry('css/app', ['./app/Resources/assets/scss/app.scss'])
    .addStyleEntry('css/admin', ['./app/Resources/assets/scss/admin.scss'])
;

module.exports = Encore.getWebpackConfig();
