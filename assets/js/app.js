
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
require('jquery-validation');
require('../../node_modules/jquery-validation/dist/additional-methods');
require('./searchBar');

require('../../node_modules/select2/dist/js/select2.min');


require('./specification');
require('bootstrap-fileinput');
require('../../node_modules/bootstrap-fileinput/js/locales/fr');
require('../../node_modules/bootstrap-fileinput/js/locales/ar');
require('../../node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min');

require('./rdcity');


require('./ad-images');
require('bootstrap');
require('./sidebar');
require('./category');
require('./gps_location');
require('./React/Startup/Search_myAds');

//-----------React.js
//require('./React/startup/result_offer_search');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
//message flash fide out
window.setTimeout(function() {
    $(".message-flash").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);








