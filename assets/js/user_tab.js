$(document).ready(function(){
    // for the points notifications link (show profile or driver)
    var linksProfiles = document.getElementsByClassName('profilePoints');
    for(var link of linksProfiles){
        link.addEventListener('click', function (e) {
            localStorage.setItem('profile_tap','#edit_personal' );
        });
    }
    var linksDrivers = document.getElementsByClassName('driverPoints');
    for(var driver of linksDrivers){
        driver.addEventListener('click', function (e) {
            localStorage.setItem('profile_tap','#edit_driver' );
        });
    }

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

    var linksDealTabs = document.getElementsByClassName('doneDealTab');
    for(var doneDeal of linksDealTabs){
        doneDeal.addEventListener('click', function (e) {
            localStorage.setItem('doneDeal_tap','#done_deals' );
        });
    }

    var inWaitingTabs = document.getElementsByClassName('inWaitingTab');
    for(var waiting of inWaitingTabs){
        waiting.addEventListener('click', function (e) {
            localStorage.setItem('driverRequest_tap','#waiting_drivers' );
        });
    }

    var doneDriverTabs = document.getElementsByClassName('doneDriverTab');
    for(var doneDriver of doneDriverTabs){
        doneDriver.addEventListener('click', function (e) {
            localStorage.setItem('driverRequest_tap','#done_drivers' );
        });
    }

    var voyageReqTabs = document.getElementsByClassName('voyageReqTab');
    for(var voyage of voyageReqTabs){
        voyage.addEventListener('click', function (e) {
            localStorage.setItem('voyage-control_tap','#joinRequest' );
        });
    }
    // whine voyage creator accept voyage request change request tab to passenger tab
    var accept_voyage_req = document.getElementsByClassName('js-accept-request');
    for(var voyage_req of accept_voyage_req){
        voyage_req.addEventListener('click', function (e) {
            localStorage.setItem('voyage-control_tap','#passengers' );
        });
    }


    //for save the tab and return to it
    $('#user-show a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('profile_tap', $(e.target).attr('href'));
    });
    $('#user-edit a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('profile_tap', $(e.target).attr('href'));
    });
    //
    $('#dealTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('doneDeal_tap', $(e.target).attr('href'));
    });

    $('#driverRequestTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('driverRequest_tap', $(e.target).attr('href'));
    });

    $('#voyage-control a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('voyage-control_tap', $(e.target).attr('href'));
    });

    var voyage_control = localStorage.getItem('voyage-control_tap');
    if(voyage_control){
        $('#voyageControlTab a[href="' + voyage_control + '"]').tab('show');
    }

    var activeTab = localStorage.getItem('profile_tap');
    if(activeTab){
        $('#user-show a[href="' + activeTab + '"]').tab('show');
        $('#user-edit a[href="' + activeTab + '"]').tab('show');
    }

    var dealTab = localStorage.getItem('doneDeal_tap');
    if(dealTab){
        $('#dealTab a[href="' + dealTab + '"]').tab('show');
    }

    var driverRequestTab = localStorage.getItem('driverRequest_tap');
    if(driverRequestTab){
        $('#driverRequestTab a[href="' + driverRequestTab + '"]').tab('show');
    }
});
$('html,body').bind('mousewheel', function(event) {
    event.preventDefault();
    var scrollTop = this.scrollTop;
    this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
    //console.log(event.deltaY, event.deltaFactor, event.originalEvent.deltaMode, event.originalEvent.wheelDelta);
});

