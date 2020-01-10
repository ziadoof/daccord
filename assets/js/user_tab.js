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

