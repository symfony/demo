var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .enableSassLoader()
    .enableVersioning(false)
    .createSharedEntry('js/common', ['jquery'])
    .addEntry('js/app', './app/Resources/assets/js/app.js')
    .addEntry('js/login', './app/Resources/assets/js/login.js')
    .addEntry('js/admin', './app/Resources/assets/js/admin.js')
    .addStyleEntry('css/app', ['./app/Resources/assets/scss/app.scss'])
    .addStyleEntry('css/admin', ['./app/Resources/assets/scss/admin.scss'])
;

module.exports = Encore.getWebpackConfig();
