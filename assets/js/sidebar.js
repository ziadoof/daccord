//sidebar//

myStorage = window.localStorage;

/*navbar toggle*/
$(document).ready(function(){
    let nav = myStorage.getItem('nav');
    if(nav === 'close'){
        $('.sidebar').addClass('fliph');
        $('.logo-acoord').toggle();
        $('.sidebar-toggle-box').toggleClass('ana');
        $('#content').addClass('mar-close').removeClass('mar-open');
    }
    else {
        $('#content').removeClass('mar-close');
    }

    $('.button-left').click(function(){
        if (nav === "close" ){
            myStorage.setItem("nav", "open");
            $('#content').toggleClass('mar-open').toggleClass('mar-close');
        }
        else {
            myStorage.setItem("nav", "close");
            $('#content').toggleClass('mar-close').toggleClass('mar-open');
        }
        $('.sidebar').toggleClass('fliph');
        $('.logo-acoord').toggle();
        $('.sidebar-toggle-box').toggleClass('ana');
    });
});
/*link logo for dashboard*/
function dashboard(){
    window.location.replace(/#0/)
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
