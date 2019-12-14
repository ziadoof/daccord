$(document).ready(function() {
    let user = document.getElementById('socket_identifier');
    let id = parseInt(user.getAttribute('data-value'));

    if (id >0){
        wsConnect(id)
    }
});

function wsConnect(id) {

        (function() {
            var ws = new WebSocket('ws://127.0.0.1:8080');
            ws.onopen = function () {
                ws.send(JSON.stringify({
                    message: 'open',
                    userId : id,
                    recipient: 0
                }));

            };

            function getNotificationText(messageData) {
                var type = messageData['typeOfNotification'];
                var text = null;
                switch (type) {
                    case 'deal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued"><i class="fas fa-handshake"></i></span>'+
                            ' New suggested deal ! '+'</p>'+
                            '<p>There is a proposed deal with <span class="blued">'+messageData['sender']+'</span>'+
                            ' regarding your AD from category <span class="blued">'+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'driverRequest':
                        text =
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued"><i class="fas fas fa-truck-moving"></i></span>'+
                            ' New driver request ! '+ '</p>'+
                            '<p><span class="blued">'+messageData['sender']+'</span> had been sent you a new driver request about the catigory ' +
                            ' <span class="blued">'+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'treatmentDriverRequest':
                        if (messageData['subject']=== 'rejected'){
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed"><i class="fas fa-times"></i></span>'+
                                ' Treatment driver request ! '+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+'</span>'+
                                ' rejected the driver\'s request that you had previously sent him about the catigory '+
                                '<span class="blued">'+messageData['category']+'</span>'+
                                '</p>';
                        }
                        else{
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed"><i class="fas fa-check"></i></span>'+
                                ' Treatment driver request ! '+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+'</span>'+
                                ' accepted the driver\'s request that you had previously sent him about the catigory '+
                                '<span class="blued">'+messageData['category']+'</span>'+
                                '</p>';
                        }
                        break;
                    case 'addDriverToDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued"><i class="fas fa-check"></i> '+' '+ ' <i class="fas fas fa-truck-moving"></i></span>'+
                            ' Add to Deal ! '+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+'</span>'+
                            ' has added you to a deal that will be executed soon about the catigory '+
                            '<span class="blued">'+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'semiDoneDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued"><i class="fas fa-handshake"></i></span>'+
                            ' Semi done Deal ! '+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+'</span>'+
                            ' has ended a deal about the catigory '+
                            '<span class="blued">'+messageData['category']+'</span>'+
                            ' that you are a member of, Waiting for other members to finish the deal '+
                            '</p>';
                        break;
                    case 'doneDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed"><i class="fas fa-handshake"></i></span>'+
                            ' DONE DEAL ! '+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+'</span>'+
                            ' has ended a deal about the catigory '+
                            '<span class="blued">'+messageData['category']+'</span>'+
                            ' that you are a member of, '+
                            '<span>The deal was terminated</span>'+
                            '</p>';
                        break;
                    case'profilePoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed"><i class="far fa-star"></i></span>'+
                            ' POINTS ! '+'</p>'+
                            '<p><span> Congratulations ... Five extra points have been added to you </span></p>';
                        break;

                    case'driverPoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed"><i class="far fa-star"></i></span>'+
                            ' POINTS ! '+'</p>'+
                            '<p><span> Congratulations ... Seven extra points have been added to you </span></p>';
                        break;
                    case'ratingDriver':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued"><i class="far fa-star"></i></span>'+
                            ' Rating ! '+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+'</span>'+
                            ' has added a rating for you as a driver, based on your latest deal. '+
                            '</p>';
                        break;
                }
                return text;
            }
            function plusCountNotification() {
                let notificationCounter = document.getElementById('notificationCount');
                if($('#notificationCount').length >0){
                    let notificationNumber = parseInt(notificationCounter.innerHTML);
                    notificationNumber++;
                    notificationCounter.innerText = notificationNumber.toString() ;
                }
                else{
                    let firstNotificationCounter = document.getElementById('notificationDropdown');
                    firstNotificationCounter.innerHTML +=
                        '<span id="notificationCount">'+1+'</span>';
                }

            }
            function sendNotification(messageData) {
                let notif = document.getElementById('new-notification');

                let link = messageData['link'];
                let notifiableId = messageData['notifiableId'];
                let notificationId = messageData['notificationId'];
                let senderUserImage = messageData['senderImage'];
                let notification_text = getNotificationText(messageData);
                let markAsSeenHref =  Routing.generate('notification_mark_as_seen',{notifiable:notifiableId,notification:notificationId});

                let now = new Date().toLocaleTimeString('en-US', { hour12: false,
                    hour: "numeric",
                    minute: "numeric"});
                let image;
                let elemantA;
                if(messageData['typeOfNotification']==='profilePoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 profilePoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/tam.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(messageData['typeOfNotification']==='driverPoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 driverPoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/tam.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else {
                    elemantA = '<a href="'+link+'" class="list__item--link my-0" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="/assets/images/profile/'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
                }

                let notification =
                    '<section class="one-note">'+
                    '<li class="list__item ">'+
                    elemantA+
                    image+
                    '<span class="messages mx-2">'
                    +notification_text+
                    '</span>'+
                    '</a>'+
                    '<div class="row">'+
                    '<div class="col btn-group">'+
                    '<div class="col-md-6 ">'+
                    '<div class="all-as-seen mark-as">'+
                    '<a href="'+markAsSeenHref+'" class="ajax-notification action-secondary">'+'Mark as seen'+'</a>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-2 offset-4">'+
                    '<div class="row">'+
                    '<div class=" mb-1 mt-0 float-right">'+
                    '<b class=" all-as-seen">'+
                    now+
                    '</b>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</li>'+
                    '</section>';

                notif.insertAdjacentHTML('afterbegin',notification);
                var btns = document.getElementsByClassName('ajax-notification');
                function markAsSeen(e) {
                    var xhttp = new XMLHttpRequest();
                    var element = e.target;
                    xhttp.onreadystatechange = function () {
                        // on success
                        if (xhttp.readyState === 4 && xhttp.status === 200) {
                            // mark notification as seen
                            /*element.parentNode.classList+= ' seen';*/
                            element.parentNode.parentNode.parentNode.parentNode.parentNode.classList+='seen';
                            // remove button
                            element.remove();
                            // decrease notification count
                            var notificationCounter = document.getElementById('notificationCount');
                            var notificationNumber = parseInt(notificationCounter.innerHTML);
                            notificationNumber--;
                            var unseen_large_Counter = document.getElementById('unseen-large-number');
                            var unseen_large_Number = parseInt(unseen_large_Counter.innerHTML);
                            unseen_large_Number--;
                            if (notificationNumber ===0){
                                notificationCounter.remove();
                            }
                            else {
                                notificationCounter.innerHTML = notificationNumber.toString();
                            }
                            unseen_large_Counter.innerHTML = unseen_large_Number.toString();
                        }
                    };
                    xhttp.open("POST", element.toString(), true);
                    xhttp.send();
                }
                for(var btn of btns){
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        markAsSeen(e);
                    });
                }
                // for add code mark as visited after send new notification
                function markAsVisited(e) {
                    const link = e.target;
                    const notifiable_id = link.parentNode.parentNode.getAttribute('notifiable');
                    const notification_id = link.parentNode.parentNode.getAttribute('notification');

                    if (notification_id !==null && notifiable_id !== null){
                        var url = Routing.generate('notification_mark_as_seen',{notifiable:notifiable_id,notification:notification_id});
                        $.ajax({
                            url: url,
                            async: true,
                            type: "POST",
                            success: function (response) {
                            }
                        });
                    }
                }

                const links = document.getElementsByClassName('list__item--link');
                for(const link of links){
                    link.addEventListener('click', function (e)
                    {
                        markAsVisited(e)
                    });
                }
                // end mark as visited
                plusCountNotification();
            }
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
            function sendSeen(messageData) {
                let messageId = parseInt(messageData['message']);
                let message = document.getElementById('message-info-'+messageId);
                let thread = messageData['thread'];
                if($('#message-center').length > 0 ){
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
            function sendMessage(messageData) {
                if($('#message-center').length > 0 ){
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
                else{
                    plusAllUnReadMessage();
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
            function messagePreparation(data) {
                let messageData = JSON.parse(data);
                if(messageData['type'])
                {
                    if(messageData['type']==='seen'){
                        sendSeen(messageData);
                    }
                    if (messageData['type']==='notification') {
                        sendNotification(messageData);
                    }
                }
                else {
                    sendMessage(messageData);
                }
            }
            function markMessagesToSeen(thread){
                let url = Routing.generate('unseen_to_seen');
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
            function sendMessageToUser(data){
                let url = Routing.generate('message_send');

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
            let threads = document.getElementsByClassName('chat');

            for (var thread of threads ){
                //for button enter to send message
                /*thread.querySelector('textarea').keyup(function(event) {
                    if (event.keyCode === 13) {
                        thread.querySelector('#send').children[1].click();
                    }
                });*/
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
                messagePreparation(event.data);
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

}

