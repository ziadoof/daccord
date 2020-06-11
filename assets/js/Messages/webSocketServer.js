import Translator from "bazinga-translator";

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
                            '<span class="blued mr-1"><i class="fas fa-handshake"></i></span>'+
                            Translator.trans('New suggested deal !')+'</p>'+
                            '<p>'+Translator.trans('There is a proposed deal with')+ '<span class="blued"> '+messageData['sender']+' </span>'+
                            Translator.trans('regarding your AD from category') +'<span class="blued"> '+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'driverRequest':
                        text =
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fas fa-truck-moving"></i></span>'+
                            Translator.trans('New driver request !')+ '</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('had been sent you a new driver request about the category')  +
                            ' <span class="blued"> '+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'treatmentDriverRequest':
                        if (messageData['subject']=== 'rejected'){
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-times"></i></span>'+
                                Translator.trans('Treatment driver request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('rejected the driver\'s request that you had previously sent him about the category')+
                                '<span class="blued"> '+messageData['category']+'</span>'+
                                '</p>';
                        }
                        else{
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-check"></i></span>'+
                                Translator.trans('Treatment driver request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('accepted the driver\'s request that you had previously sent him about the category')+
                                '<span class="blued"> '+messageData['category']+'</span>'+
                                '</p>';
                        }
                        break;
                    case 'addDriverToDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-check"></i> '+' '+ ' <i class="fas fas fa-truck-moving"></i></span>'+
                            Translator.trans('Add to Deal !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has added you to a deal that will be executed soon about the category')+
                            '<span class="blued"> '+messageData['category']+'</span>'+
                            '</p>';
                        break;
                    case 'semiDoneDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-handshake"></i></span>'+
                            Translator.trans('Semi done Deal !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has ended a deal about the category')+
                            '<span class="blued"> '+messageData['category']+' </span>'+
                            Translator.trans('that you are a member of, Waiting for other members to finish the deal')+
                            '</p>';
                        break;
                    case 'doneDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="fas fa-handshake"></i></span>'+
                            Translator.trans('DONE DEAL !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has ended a deal about the category')+
                            '<span class="blued"> '+messageData['category']+' </span>'+
                            Translator.trans('that you are a member of,')+
                            '<span>'+Translator.trans('The deal was terminated')+'</span>'+
                            '</p>';
                        break;
                    case'profilePoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span>'+Translator.trans('Congratulations ... Five extra points have been added to you') +'</span></p>';
                        break;

                    case'driverPoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span>'+Translator.trans('Congratulations ... Seven extra points have been added to you')+ '</span></p>';
                        break;
                    case'ratingDriver':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('Rating !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has added a rating for you as a driver, based on your latest deal.')+
                            '</p>';
                        break;
                    case'ratingHosting':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('Rating !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has added a rating for you as a hosting, based on your latest hosting.')+
                            '</p>';
                        break;
                    case'hostingRequest':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-suitcase-rolling ml-0"></i></span>'+
                            Translator.trans('New hosting request !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('had been sent you a new hosting request..!')+
                            '</p>';
                        break;
                    case 'treatmentHostingRequest':
                        if (messageData['subject']=== 'rejected'){
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-times"></i></span>'+
                                Translator.trans('Treatment hosting request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('rejected the hosting\'s request that you had previously sent him.')+
                                '</p>';
                        }
                        else{
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-check"></i></span>'+
                                Translator.trans('Treatment hosting request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('accepted the hosting\'s request that you had previously sent him.')+
                                '</p>';
                        }
                        break;
                    case'doneHosting':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="fas fa-suitcase-rolling ml-0"></i></span>'+
                            Translator.trans('Done hosting !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('had ended the hosting that you are part of...!')+
                            '</p>';
                        break;
                    case'hostingPoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span >'+Translator.trans('Congratulations ... Ten extra points have been added to your hosting profile.')+'</span>'+
                            '</p>';
                        break;
                    case'meetupRequest':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-user-friends"></i></span>'+
                            Translator.trans('New Meetup join request !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('had been sent you a new meetup join request..!')+
                            '</p>';
                        break;
                    case 'treatmentMeetupRequest':
                        if (messageData['subject']=== 'Rejected'){
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-times"></i></span>'+
                                Translator.trans('Treatment meetup join request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('rejected the meetup join request that you had previously sent him.')+
                                '</p>';
                        }
                        else{
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-check"></i></span>'+
                                Translator.trans('Treatment meetup join request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('accepted the meetup join request that you had previously sent him.')+
                                '</p>';
                        }
                        break;
                    case'cancelJoinParticipant':
                        let statusParticipant = '';
                        if(messageData['subject']=== 'removed'){
                            statusParticipant = Translator.trans('had canceled your participation in his meetup.');
                        }
                        else{
                            statusParticipant = Translator.trans('had canceled his participation in your meetup.');
                        }
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-calendar-times"></i></span>'+
                            Translator.trans('Cancel meetup join !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            statusParticipant
                            +'</p>';
                        break;
                    case'cancelJoinWaiting':
                        let statusWaiting = '';
                        if(messageData['subject']=== 'removed'){
                            statusWaiting = Translator.trans('had canceled your subscription to the waiting list in his meetup.');
                        }
                        else{
                            statusWaiting = Translator.trans('had canceled his subscription to the waiting list in your meetup.');
                        }
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-calendar-times"></i></span>'+
                            Translator.trans('Cancel meetup join!')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            statusWaiting
                            +'</p>';
                        break;
                    case'transferToParticipant':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-exchange-alt"></i></span>'+
                            Translator.trans('Transfer to participants list !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('transferred you from the waiting list to the participants in his meetup ..!')+
                            '</p>';
                        break;
                    case'meetupComment':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="far fa-comment-alt"></i></span>'+
                            Translator.trans('New comment !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('added a comment to an meetup where you are a member..!')+
                            '</p>';
                        break;
                    case'ratingMeetup':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('Rating !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has added a rating for your meetup.')+
                            '</p>';
                        break;
                    case'voyageRequest':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="fas fa-car"></i></span>'+
                            Translator.trans('New voyage join request !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('had been sent you a new voyage join request..!')+
                            '</p>';
                        break;
                    case 'treatmentVoyageRequest':
                        if (messageData['subject']=== 'Rejected'){
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="rosed mr-1"><i class="fas fa-times"></i></span>'+
                                Translator.trans('Treatment voyage join request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('rejected the voyage join request that you had previously sent him.')+
                                '</p>';
                        }
                        else{
                            text=
                                '<p class="font-weight-bold mb-0">'+
                                '<span class="blued mr-1"><i class="fas fa-check"></i></span>'+
                                Translator.trans('Treatment voyage join request !')+'</p>'+
                                '<p><span class="blued">'+messageData['sender']+' </span>'+
                                Translator.trans('accepted the voyage join request that you had previously sent him.')+
                                '</p>';
                        }
                        break;
                    case'voyageRemovePassenger':
                        let statusRemovedPassenger = '';
                        if(messageData['subject']=== 'removed'){
                            statusRemovedPassenger = Translator.trans('had canceled your subscription in his voyage.');
                        }
                        else{
                            statusRemovedPassenger = Translator.trans('had canceled his subscription in your voyage.');
                        }
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-calendar-times"></i></span>'+
                            Translator.trans('Cancel voyage join!')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            statusRemovedPassenger
                            +'</p>';
                        break;
                    case'removeUserPoints':
                        let numberOfPoints = '';
                        if(messageData['category']=== '0'){
                            numberOfPoints = Translator.trans('You have no points left!.');
                        }
                        else{
                            let lost = Translator.trans('You lost');
                            let point = Translator.trans('points.');
                            numberOfPoints = lost +'<span> '+messageData['category']+' </span>' +point;
                        }
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span>'+ numberOfPoints +'</span></p>';
                        break;
                    case'removeCarpoolPoints':
                        let carpoolPoints = '';
                        if(messageData['category']=== '0'){
                            carpoolPoints = Translator.trans('You have no points left as carpool!.');
                        }
                        else{
                            let lost = Translator.trans('You lost');
                            let point = Translator.trans('points as carpool!.');
                            carpoolPoints = lost +'<span> '+messageData['category']+' </span>' +point;
                        }
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span>'+ carpoolPoints +'</span></p>';
                        break;
                    case'carpoolAddPoints':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span>'+Translator.trans('Congratulations ... 30 extra points have been added to you as carpool')+'</span></p>';
                        break;
                    case'ratingCarpool':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="blued mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('Rating !')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has added a rating for you as a carpool, based on your latest voyage.')+
                            '</p>';
                        break;
                    case'cancelVoyage':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-calendar-times"></i></span>'+
                            Translator.trans('Cancel voyage!')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('canceled a voyage you are traveling on.')
                            +'</p>';
                        break;
                    case'pointsVoyageCanceled':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="far fa-star"></i></span>'+
                            Translator.trans('POINTS !')+'</p>'+
                            '<p><span >'+Translator.trans('You earned five extra points for canceling a voyage you are traveling on.')+'</span>'+
                            '</p>';
                        break;
                    case'cancelDeal':
                        text=
                            '<p class="font-weight-bold mb-0">'+
                            '<span class="rosed mr-1"><i class="fas fa-exclamation-triangle"></i></span>'+
                            Translator.trans('Cancel deal!')+'</p>'+
                            '<p><span class="blued">'+messageData['sender']+' </span>'+
                            Translator.trans('has canceled the deal that you were part of, and was to be executed soon,about the category') +
                            '<span class="blued"> '+messageData['category']+'</span>'
                            +'</p>';
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
                let typeON = messageData['typeOfNotification'];
                if(typeON==='profilePoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 profilePoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='driverPoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 driverPoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='hostingPoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 hostingPoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='removeUserPoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 profilePoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='pointsVoyageCanceled'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 profilePoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='removeCarpoolPoints'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 carpoolPoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='carpoolAddPoints' || typeON==='ratingCarpool' ){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 carpoolPoints" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image = '<img src="/assets/images/icons/face-icon.png" alt="" class="user-image mx-2 mt-1" />';
                }
                else if(typeON==='ratingMeetup'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 ratingMeetup" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
                }
                else if(typeON==='meetupComment'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 meetupComment" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
                }
                else if(typeON==='meetupRequest'||typeON ==='treatmentMeetupRequest'||typeON ==='cancelJoinParticipant'||typeON ==='cancelJoinWaiting'||typeON ==='transferToParticipant'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 meetupParticipant" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
                }
                else if(typeON==='doneDeal'){
                    elemantA = '<a href="'+link+'" class="list__item--link my-0 doneDealTab" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
                }
                else {
                    elemantA = '<a href="'+link+'" class="list__item--link my-0" notifiable="'+notifiableId+'" notification="'+notificationId+'">';
                    image='<img src="'+senderUserImage+'" alt="" class="user-image mx-2 mt-1">';
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
                    '<div class="col-6 col-md-6 ">'+
                    '<div class="all-as-seen mark-as">'+
                    '<a href="'+markAsSeenHref+'" class="ajax-notification action-secondary">'+'Mark as seen'+'</a>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-6 col-md-2 offset-4">'+
                    '<div class="row">'+
                    '<div class=" mb-1 mt-0">'+
                    '<b class=" all-as-seen  float-right">'+
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
                // reload function for fix link to comment and rating with realtime notifications
                const participants = document.getElementsByClassName('meetupParticipant');
                for(const participant of participants){
                    participant.addEventListener('click', function () {
                        localStorage.setItem('meetup_tab','#meetupParticipant' );
                    });
                }
                const linksComments = document.getElementsByClassName('meetupComment');
                for(const comment of linksComments){
                    comment.addEventListener('click', function () {
                        localStorage.setItem('meetup_tab','#meetupComment' );

                    });
                }
                const linksMeets = document.getElementsByClassName('ratingMeetup');
                for(const meetup of linksMeets){
                    meetup.addEventListener('click', function () {
                        localStorage.setItem('meetup_tab','#meetupRating' );
                    });
                }
                // for the points notifications link (show profile or driver)
                var linksProfiles = document.getElementsByClassName('profilePoints');
                for(var linkP of linksProfiles){
                    linkP.addEventListener('click', function (e) {
                        localStorage.setItem('profile_tap','#edit_personal' );
                    });
                }
                var linksDrivers = document.getElementsByClassName('driverPoints');
                for(var driverP of linksDrivers){
                    driverP.addEventListener('click', function (e) {
                        localStorage.setItem('profile_tap','#edit_driver' );
                    });
                }

                var linksHosting = document.getElementsByClassName('hostingPoints');
                for(var hostingP of linksHosting){
                    hostingP.addEventListener('click', function (e) {
                        localStorage.setItem('profile_tap','#edit_hosting' );
                    });
                }
                var linksCarpool = document.getElementsByClassName('carpoolPoints');
                for(var carpoolP of linksCarpool){
                    carpoolP.addEventListener('click', function (e) {
                        localStorage.setItem('profile_tap','#edit_carpool' );
                    });
                }

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
                    /*let messageDom = this.parentNode.children[0].children[0].children[0];*/
                    let messageDom = this.parentNode.children[0].children[0].children[1];
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

