var Encore = require('@symfony/webpack-encore');

Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addEntry('style', './assets/scss/main.scss')
    /*.addEntry('jquery', './assets/js/jquery.init.js')*/
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    .autoProvideVariables({
        "Routing": "router"
    })
    .addLoader({
        test: /jsrouting-bundle\/Resources\/public\/js\/router.js$/,

    });

let config = Encore.getWebpackConfig();


config.resolve.alias = {

    'router': __dirname + '/assets/js/router.js'

};

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()


module.exports = config;
