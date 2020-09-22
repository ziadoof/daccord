
var $ = require('jquery');
window.$ = $;
window.jQuery = $;
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything




require('./router');
require('./jquery-ui.min');
require('../../public/bundles/pugxautocompleter/js/autocompleter-jqueryui');
require('./search_city');
require('jquery-validation');
require('../../node_modules/jquery-validation/dist/additional-methods');
require('./searchBar');

require('../../node_modules/select2/dist/js/select2.min');


require('./specificationAndCityAutoCompleter');
require('bootstrap-fileinput');
require('../../node_modules/bootstrap-fileinput/js/locales/fr');
require('../../node_modules/bootstrap-fileinput/js/locales/ar');
require('../../node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min');

require('./rdcity');
require('eonasdan-bootstrap-datetimepicker');

require('tail.datetime/js/tail.datetime-full');


require('./meetup/meetupDate');

require('bootstrap');
require('./sidebar');
require('./category');
require('./gps_location');
require('./React/Startup/Search_myAds');
require('./viewImage');
require('./meetup/meetup_tab');
require('./user_tab');
require('./notification');
require('./Messages/webSocketServer');
require('./Messages/scrollMessage');
require('./rating');
require('./markAsVisited');
require('./invitations');
require('./hostingDate');
require('./meetup/meetup_gps');
require('./voyage/jquery.collection');
require('./voyage/voyage');
require('./voyage/searchVoyage');
require('./favorite');
require('./admin/admin');

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
    $('.message-flash').toggle("slide", { direction: "right" }, 50);
}, 5000)


$(document).ready(function (){
    $('[data-toggle="tooltip"]').tooltip({
        container : 'body'
    })
})
//----------------------------------------------------------------------
$(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sm-sidebar").toggleClass("toggled");
});

// cookies
function termsUse() {
    var el = document.getElementById( 'terms-use' );
    if ( el ) {
        /*var cmd = el.querySelectorAll( 'a' )[0];*/
        var cmd = document.getElementById('b_cookies');
        el.style.display = 'block'; // @note Par défaut l'élément est caché afin d'éviter un visuel désagréable au chargement de la page
        cmd.onclick = function(){
            localStorage.setItem( 'termsuse', 'true' );
            el.style.display = 'none';
        };
        if (localStorage.getItem( 'termsuse' ) === 'true' ) {
            el.style.display = 'none';
        }
    }
}
termsUse();