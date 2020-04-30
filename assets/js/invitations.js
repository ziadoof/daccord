import Translator from "bazinga-translator";

$("#btn-cafe-gps").click(function(e) {
    e.preventDefault();
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }else{
        let error_message = Translator.trans('Geolocation is not supported by this browser.');
        alert(error_message);
    }

});

function showPosition(position){
    let lat= position.coords.latitude;
    let lng= position.coords.longitude;

    $('#cafe_gps_lat').val( lat);
    $('#cafe_gps_lng').val( lng);
    document.getElementById("cafe-gps").submit();
}

$("#btn-cafe_deactivate").click(function(e) {
    e.preventDefault();
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(cafeShowPosition);
    }else{
        let error_message = Translator.trans('Geolocation is not supported by this browser.');
        alert(error_message);
    }

});

function cafeShowPosition(position){
    let lat= position.coords.latitude;
    let lng= position.coords.longitude;

    $('#cafe_deactivate_gps_lat').val( lat);
    $('#cafe_deactivate_gps_lng').val( lng);
    document.getElementById("cafe_deactivate").submit();

}

$(document).ready(function () {
    var cafe_messages = document.getElementsByClassName('cafe-message');
    for (var cafe_message of cafe_messages){
        cafe_message.addEventListener('click',function () {
            let userId = this.children[0].children[0].getAttribute('value');
            if(userId){
                localStorage.setItem('message-tap', '#user-'+userId);
            }
            else {
                localStorage.setItem('message-tap', null);
            }
        })
    }

});

function makeTimer(id) {

    var div = document.getElementById(id);
    var endTime = div.children[0].getAttribute('value');
    endTime = (Date.parse(endTime) / 1000);
    var now = new Date();
    now = (Date.parse(now) / 1000);

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

    if (hours < "10") { hours = "0" + hours; }
    if (minutes < "10") { minutes = "0" + minutes; }
    if (seconds < "10") { seconds = "0" + seconds; }

    var htmlHours =  document.getElementById(id).getElementsByClassName("hours")[0];
    var htmlMinutes =  document.getElementById(id).getElementsByClassName("minutes")[0];
    var htmlSeconds =  document.getElementById(id).getElementsByClassName("seconds")[0];



    if(endTime > now){
        $(htmlHours).html(hours+':');
        $(htmlMinutes).html(minutes);
        $(htmlSeconds).html(seconds);
    }
    else {
        let element = document.getElementById('div-'+id);
        let yourCafe = document.getElementById('myCafe');
        if(element.getAttribute('data-value')==='myCafe'){
            element.remove();
            yourCafe.innerHTML = Translator.trans('Your cafe has expired');
        }
        else{
            let anotherCafes = document.getElementsByClassName('anotherCafe');
            if(anotherCafes.length>1){
                element.remove();
            }
            else {
                let anotherCafe = document.getElementById('anotherCafe');
                element.remove();
                anotherCafe.innerHTML = Translator.trans('There is no invitations in your area');
            }
        }
    }


}
let cafe_timers = document.getElementsByClassName('cafe-timer');
for (const cafe of cafe_timers){
    const id = cafe.getAttribute('id');
    setInterval(function() { makeTimer(id); }, 1000);
}
