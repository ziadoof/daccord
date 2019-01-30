
var $ = require('jquery');
window.$ = $;
window.jQuery = $;

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

require('./jquery-ui.min');
require('../../public/bundles/pugxautocompleter/js/autocompleter-jqueryui')
require('./autocompleter');
require('./category');
require('./rdcity');
require('bootstrap-fileinput');
require('../../node_modules/bootstrap-fileinput/js/locales/fr');
require('../../node_modules/bootstrap-fileinput/js/locales/ar');

require('./ad-images');
require('bootstrap');
require('./sidebar');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});







