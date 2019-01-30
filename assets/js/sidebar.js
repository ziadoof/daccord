//sidebar//

myStorage = window.localStorage;

/*navbar toggle*/
$(document).ready(function(){
    $('.button-left').click(function(){
        $('.sub-menu').toggleClass('collapse');
        if (myStorage.getItem("nav") === "desactive" ){
            myStorage.setItem("nav", "active");
            /* $('.wrapper').css({
                 'margin-left': '-100px'
             });*/
            $('.centr-changer').addClass('col-md-10 col-md-offset-1  col-sm-8 col-sm-offset-2 col-xs-6 col-xs-offset-3').removeClass('col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-4 col-xs-6 col-xs-offset-5');

        }
        else {
            myStorage.setItem("nav", "desactive");
            /* $('.wrapper').css({
                 'margin-left': '100px'
             });*/
            $('.centr-changer').addClass('col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-4 col-xs-6 col-xs-offset-5').removeClass('col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-6 col-xs-offset-3 ');

        }
        $('.sidebar').toggleClass('fliph');
        $('.logo-acoord').toggle();
        $('.sidebar-toggle-box').toggleClass('ana');
    });
});
/* save navbar status*/
$( window ).on(function() {
    if (myStorage.getItem('nav') === "active"){
        fliph();
    }
});
/*link logo for dashboard*/
function dashboard(){
    window.location.replace(/#0/)
}
/*for use whene navbar status*/
function fliph() {
    $('.sidebar').toggleClass('fliph');
    $('.logo-acoord').toggle();
    $('.sidebar-toggle-box').toggleClass('ana');
}
var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight );

var wrap = $(".sidebar");

$(document).ready( function(e) {
    if (height < 800) {
        wrap.addClass("fix-search");
    } else {
        wrap.removeClass("fix-search");
    }
});
