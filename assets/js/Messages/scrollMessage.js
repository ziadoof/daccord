$(document).ready(function () {
    $(".chat-messages").animate({ scrollTop: 20000000 }, "slow");

    //for save the tab and return to it
    $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
        localStorage.setItem('message-tap', $(e.target).attr('href'));
    });
    var message = localStorage.getItem('message-tap');
    if(message){
        $('#v-pills-tab a[href="' + message + '"]').tab('show');
    }

    var offerUser = document.getElementById('offerUser-message');
    var demandUser = document.getElementById('demandUser-message');

    if(offerUser){
        offerUser.addEventListener('click',function () {
            let offerUserId = this.children[0].children[0].getAttribute('value');
            if(offerUserId){
                localStorage.setItem('message-tap', '#user-'+offerUserId);
            }
            else {
                localStorage.setItem('message-tap', null);
            }

        });
    }
    if(demandUser){
        demandUser.addEventListener('click',function () {
            let demandUserId = this.children[0].children[0].getAttribute('value');
            if (demandUserId){
                localStorage.setItem('message-tap', '#user-'+demandUserId);
            }
            else {
                localStorage.setItem('message-tap', null);
            }

        });
    }
});

        // زر سيند وتحسس زر انتر
        /*textSender.onclick = sendTextInputContent;
        _textInput.onkeyup = function(e) {
            // Check for Enter key
            if (e.keyCode === enterKeyCode) {
                sendTextInputContent();
            }
        };*/