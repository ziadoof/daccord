
var $ = require('jquery');
window.$ = $;
window.jQuery = $;

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('./router');
require('./jquery-ui.min');
require('../../public/bundles/pugxautocompleter/js/autocompleter-jqueryui')
require('./autocompleter');
require('./autocompleter_offer_city');

require('./rdcity');
require('./specification');
require('bootstrap-fileinput');
require('../../node_modules/bootstrap-fileinput/js/locales/fr');
require('../../node_modules/bootstrap-fileinput/js/locales/ar');

require('./ad-images');
require('bootstrap');
require('./sidebar');
require('./category');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

/*    document.getElementById('offer_donate').onchange = function() {
    document.getElementById('offer_title').disabled = this.checked;
};*/

$(document).on('click', "#offer_donate",function () {
    document.getElementById('offer_price').disabled = this.checked;

});






