    var Encore = require('@symfony/webpack-encore');

    Encore
        .setOutputPath('public/build/')
        .setPublicPath('/public')
        .addEntry('app', './public/assets/js/app.js')
	    .addEntry('style', './public/assets/scss/main.scss')
	    .addEntry('jquery-3.3.1.min.js', './public/assets/js/jquery-3.3.1.min.js')
        .cleanupOutputBeforeBuild()
        /*.enableSourceMaps(!Encore.isProduction())*/
        .enableBuildNotifications()
	    .enableSassLoader();

    module.exports = Encore.getWebpackConfig();
