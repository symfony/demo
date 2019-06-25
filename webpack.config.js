// This project uses "Yarn" package manager for managing JavaScript dependencies along
// with "Webpack Encore" library that helps working with the CSS and JavaScript files
// that are stored in the "assets/" directory.
//
// Read https://symfony.com/doc/current/frontend.html to learn more about how
// to manage CSS and JavaScript files in Symfony applications.
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "window.Bloodhound": require.resolve('bloodhound-js'),
        "jQuery.tagsinput": "bootstrap-tagsinput"
    })
    .enableSassLoader()
    // when versioning is enabled, each filename will include a hash that changes
    // whenever the contents of that file change. This allows you to use aggressive
    // caching strategies. Use Encore.isProduction() to enable it only for production.
    .enableVersioning(false)
    .addEntry('app', './assets/js/app.js')
    .addEntry('login', './assets/js/login.js')
    .addEntry('admin', './assets/js/admin.js')
    .addEntry('search', './assets/js/search.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .enableIntegrityHashes(Encore.isProduction())
    .configureBabel(null, {
        useBuiltIns: 'usage',
        corejs: 3,
    })
;

module.exports = Encore.getWebpackConfig();
