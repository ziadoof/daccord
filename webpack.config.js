    var Encore = require('@symfony/webpack-encore');

    Encore
        .setOutputPath('public/build/')
        .setPublicPath('/public')
        .addEntry('app', './public/assets/js/app.js')
	    .addEntry('style', './public/assets/scss/main.scss')
        .cleanupOutputBeforeBuild()
        .enableBuildNotifications()
	    .enableSassLoader();

    module.exports = Encore.getWebpackConfig();
