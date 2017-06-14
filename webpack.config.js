var Encore = require('@symfony/webpack-encore');
var webpack = require('webpack');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "window.jQuery": "jquery",
        "window.Bloodhound": require.resolve('bloodhound-js'),
        "jQuery.tagsinput": "bootstrap-tagsinput"
    })
    .enableSassLoader()
    .enableVersioning(false)
    .createSharedEntry('js/common', ['jquery'])
    .addEntry('js/app', './app/Resources/assets/js/app.js')
    .addEntry('js/login', './app/Resources/assets/js/login.js')
    .addEntry('js/admin', './app/Resources/assets/js/admin.js')
    .addStyleEntry('css/app', ['./app/Resources/assets/scss/app.scss'])
    .addStyleEntry('css/admin', ['./app/Resources/assets/scss/admin.scss'])
;

var config = Encore.getWebpackConfig();

config.plugins.push(new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/));

module.exports = config;
