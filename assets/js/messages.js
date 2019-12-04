 (function() {
            var ws = new WebSocket('ws://localhost:8080');
            let url_user_id = "{{path('getCurrentUserId')}}";
            ws.onopen = function () {
                $.ajax({
                    method: "post",
                    dataType: "json",
                    url: url_user_id,
                }).done( function(response) {
                    ws.send(JSON.stringify({
                        message: 'open',
                        userId : response,
                        recipient: 0
                    }));
                }).fail(function(){

                    alert('filer');
                });
            };
            function loseAllUnReadMessage() {
                let messageCounter = document.getElementById('messagesCount');
                let firstMessageCounter = document.getElementById('centerOfMessages');
                let messageNumber = parseInt(messageCounter.innerHTML);
                if(messageNumber === 1){
                    let id = 'messagesCount';
                    firstMessageCounter.innerHTML =
                        '<p id= '+id+' class="hide-padge"></p>';
                }
                else{
                    messageNumber--;
                    messageCounter.innerText = messageNumber.toString() ;
                }
            }
            function plusAllUnReadMessage() {
                let messageCounter = document.getElementById('messagesCount');
                let firstMessageCounter = document.getElementById('centerOfMessages');
                let messageNumber = parseInt(messageCounter.innerHTML);
                if(isNaN(messageNumber)|| messageNumber === 0){
                    let id = 'messagesCount';
                    firstMessageCounter.innerHTML =
                        '<p id= '+id+'>' +1+ '</p>';
                }
                else{
                    messageNumber++;
                    messageCounter.innerText = messageNumber.toString() ;
                }
            }
            function addMessage(data) {
                let messageData = JSON.parse(data);
                if(messageData['type']){
                    if(messageData['type']==='seen'){
                        let messageId = parseInt(messageData['message']);
                        let message = document.getElementById('message-info-'+messageId);
                        let thread = messageData['thread'];
                        if(message){
                            $("#message-info-"+messageId).find("i").removeClass('far fa-clock').addClass('fas fa-check');
                        }
                        else {
                            let thread_messages = document.getElementById('messages-chat-'+thread);
                            let temporary_messages = thread_messages.getElementsByClassName('temporary-message');
                            $(temporary_messages).removeClass('far fa-clock temporary-message').addClass('fas fa-check');
                        }
                    }
                }
                else {
                    let message = messageData['message'];
                    let thread = messageData['thread'];
                    let date = new Date();
                    let now = new Date().toLocaleTimeString('en-US', { hour12: false,
                        hour: "numeric",
                        minute: "numeric"});

                    let _receiver = document.getElementById('messages-chat-'+thread);
                    let active = _receiver.parentNode.getAttribute('id');
                    let isActive = $('#'+active).hasClass('active');
                    let messageCounter = document.getElementById('new-message-'+thread);
                    let firstMessageCounter = document.getElementById('first-message-'+thread);
                    _receiver.innerHTML +=
                        '<br>'+
                        '<div class=" my-2 py-2 messenger_thread_message d-inline-block col-md-6 offset-6 box-clint">'+
                        '<div class="messenger_thread_message_body d-block" >'+
                        '<p class=" clint-message">' + message + '</p>'+
                        '</div>'+
                        '<div class="messenger_thread_message_info d-block " id="">'+
                        '<small class="clint-message float-right">'+
                        now
                        +'</small>'+
                        '</div>'+
                        '</div>';
                    jQuery("div#messages-chat-"+thread).scrollTop(jQuery("div#messages-chat-"+thread)[0].scrollHeight);
                    let id = 'new-message-'+thread;
                    if(!isActive)
                    {
                        if(null === messageCounter){
                            firstMessageCounter.innerHTML =
                                '<p id= '+id+' class=" ml-2 mt-4 float-right new-message ">' +1+ '</p>';

                        }
                        else{

                            let messageNumber = parseInt(messageCounter.innerHTML);
                            if(isNaN(messageNumber)){
                                firstMessageCounter.innerHTML =
                                    '<p id= '+id+' class=" ml-2 mt-4 float-right new-message ">' +1+ '</p>';
                            }
                            else{
                                messageNumber++;
                                messageCounter.innerText = messageNumber.toString() ;
                            }
                        }
                        plusAllUnReadMessage();
                    }
                    else{
                        markMessagesToSeen(thread);
                    }
                    plusNumberMessagesThread(thread);
                }
            }
            function addMessageToCurrentUser(message, thread) {
                let now = new Date().toLocaleTimeString('en-US', { hour12: false,
                    hour: "numeric",
                    minute: "numeric"});
                var _receiver = document.getElementById('messages-chat-'+thread);
                _receiver.innerHTML +=
                    '<br>'+
                    '<div class=" my-2 py-2 messenger_thread_message d-inline-block col-md-6  box-user" id="temporary-message">'+
                    '<div class="messenger_thread_message_body d-block" >'+
                    '<p class=" user-message">' + message + '</p>'+
                    '</div>'+
                    '<div class="messenger_thread_message_info d-block " id="">'+
                    '<small class="user-message float-right">'+ now +' <i class="far fa-clock temporary-message"></i>'+'</small>'+
                    '</div>'+
                    '</div>';
                jQuery("div#messages-chat-"+thread).scrollTop(jQuery("div#messages-chat-"+thread)[0].scrollHeight);
                removePadge(thread);
                plusNumberMessagesThread(thread);

            }
            function sendMessageToUser(data){
                let url = "{{path('message_send')}}";

                if(data['message'] !== ""){
                    $.ajax({
                        method: "post",
                        dataType: "json",
                        url: url,
                        async: true,
                        data:data,
                    }).done( function(response) {
                        ws.send(JSON.stringify({
                            message: response[0],
                            thread : response[1],
                            recipient: response[2]
                        }));
                        addMessageToCurrentUser(response[0],response[1]);

                    }).fail(function(jxh,textmsg,errorThrown){
                        alert('filer');
                    });
                }

            }
            function plusNumberMessagesThread(thread){
                let number = document.getElementById('numberMessagesThread-'+thread);
                let text_value = $('#numberMessagesThread-'+thread).text();
                let value = parseInt(text_value);
                value++;
                number.innerHTML = '<b class="title-blue" id="numberMessagesThread-'+thread+'">'+value+'</b>';

            }
            function removePadge(thread) {
                let n = $('#new-message-'+thread).text();
                if(n>0){
                    let firstMessageCounter = document.getElementById('first-message-'+thread);
                    let id = 'new-message-'+thread;
                    firstMessageCounter.innerHTML = '<p id= '+id+' class="hide-padge"></p>';
                }
            }
            function markMessagesToSeen(thread){
                let url = "{{path('unseen_to_seen')}}";
                let data = {'thread':thread};
                $.ajax({
                    method: "post",
                    dataType: "json",
                    url: url,
                    async: true,
                    data:data,
                }).done( function(response) {
                    removePadge(response[0]);
                    if(response[3]){
                        for(var message of response[1]){
                            ws.send(JSON.stringify({
                                thread: response[0],
                                messages : message,
                                recipient: response[2],
                                message: 'seen',
                                type:'seen'
                            }));
                        }
                    }
                    for (var mess of response[1]){
                        loseAllUnReadMessage();
                    }

                }).fail(function(jxh,textmsg,errorThrown){
                    alert('filer');
                });
            }
            let threads = document.getElementsByClassName('chat');

            for (var thread of threads ){

                thread.querySelector('#send').children[1].addEventListener('click', function (e) {
                    e.preventDefault();

                    let conversation = this.parentNode.getAttribute('data-conversation');
                    let recipient = this.parentNode.getAttribute('data-user');
                    let messageDom = this.parentNode.children[0].children[0].children[0];
                    let message = messageDom.value.replace(/<\/?[^>]+(>|$)/g, "");

                    let data = {'conversation':conversation,'message':message,'recipient':recipient};
                    if (message !== '' && message.trim() !== ''){
                        sendMessageToUser(data);
                        messageDom.value=null;
                    }


                    return false;
                });
            }

            ws.onmessage = function (event) {
                console.log(event.data);
                if($('#message-center').length > 0 ){
                    addMessage(event.data);
                }
                else{
                    plusAllUnReadMessage();
                }
            };
            ws.onerror = function () {
                 addMessage('An error occured!');
            };


            let element = document.getElementsByClassName('thread-link');
            for (var link of element){
                link.addEventListener('click',function () {
                    let thread_id = this.getAttribute('data-idOfThread');
                    $(".chat-messages").animate({ scrollTop: 20000000 }, "slow");
                    markMessagesToSeen(thread_id);
                })
            }

            if($('#message-center').length > 0 ){
                let parent = document.getElementById('v-pills-tabContent');
                if(parent){
                    let newMessage = parent.querySelector('.new_chat');
                    if(newMessage ===null){
                        var href = localStorage.getItem('message-tap');
                        let active;
                        if(href){
                             active = parent.querySelector(href);
                        }
                        else {
                             active = parent.querySelector('.active .show');
                        }
                        let thread = active.getAttribute('data-thread');
                        markMessagesToSeen(thread);
                    }
                }
            }

        })();

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

