    var Encore = require('@symfony/webpack-encore');

	Encore
        .setOutputPath('public/build/')
        .setPublicPath('/public')
		.cleanupOutputBeforeBuild()
		.enableSourceMaps(!Encore.isProduction())
		.addEntry('jquery', './public/assets/js/jquery.init.js')
		.addEntry('app', './public/assets/js/app.js')
	    .addEntry('style', './public/assets/scss/main.scss')
	   /* .addEntry('jquery-3.3.1.min', './public/assets/js/jquery-3.3.1.min.js')
	    .addEntry('jquery-ui.min', './public/assets/js/jquery-ui.min.js')
	    .addEntry('autocompleter', './public/assets/js/autocompleter.js')*/
	    /*.addEntry('autocompleter-jqueryui', './public/assets/js/autocompleter-jqueryui')*/
        .enableBuildNotifications()
	    .enableSassLoader();


	module.exports = Encore.getWebpackConfig();


