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

    //for save the tab and return to it
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('profile_tap', $(e.target).attr('href'));
    });
    //

    var activeTab = localStorage.getItem('profile_tap');
    if(activeTab){
        $('#user-show a[href="' + activeTab + '"]').tab('show');
        $('#user-edit a[href="' + activeTab + '"]').tab('show');

    }
});

