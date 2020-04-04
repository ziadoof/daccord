$(document).ready(function(){

    const linksMeets = document.getElementsByClassName('ratingMeetup');
    for(const meetup of linksMeets){
      meetup.addEventListener('click', function () {
          localStorage.setItem('meetup_tab','#meetupRating' );

      });
    }

    const linksComments = document.getElementsByClassName('meetupComment');
    for(const comment of linksComments){
        comment.addEventListener('click', function () {
            localStorage.setItem('meetup_tab','#meetupComment' );

        });
    }

    const participants = document.getElementsByClassName('meetupParticipant');
    for(const participant of participants){
        participant.addEventListener('click', function () {
            localStorage.setItem('meetup_tab','#meetupParticipant' );

        });
    }

    $("#js_meetup_tab a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
        localStorage.setItem('meetup_tab', $(e.target).attr('href'));

    });

    var activeMeetupTab = localStorage.getItem('meetup_tab');
    if(activeMeetupTab){
      $('#js_meetup_tab a[href="' + activeMeetupTab + '"]').tab('show');
    }
});