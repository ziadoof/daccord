import Translator from 'bazinga-translator';

$(document).ready(function () {
    $(".chat-messages").animate({ scrollTop: 20000000 }, "slow");

    // add placeholder for text area message
    $("#message_body").attr("placeholder", Translator.trans("Write your message..."));

    //for save the tab and return to it
    $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
        localStorage.setItem('message-tap', $(e.target).attr('href'));
    });
    var message = localStorage.getItem('message-tap');
    if(message){
        $('#v-pills-tab a[href="' + message + '"]').tab('show');
    }

    const user_messages = document.getElementsByClassName('js-user-message');

    for (const user of user_messages){
        if(user){
            user.addEventListener('click',function () {
                let userId = this.children[0].children[0].getAttribute('value');
                if(userId){
                    localStorage.setItem('message-tap', '#user-'+userId);
                }
                else {
                    localStorage.setItem('message-tap', null);
                }
            });
        }
    }
    let general = document.getElementById('js-general-message-center');
    general.addEventListener('click', function () {
        localStorage.setItem('message-tap', null);
    })



});
