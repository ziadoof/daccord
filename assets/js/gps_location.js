import Translator from 'bazinga-translator';

//test//
$(document).ready(function() {
   /* let nearMe = localStorage.getItem('offer_nearme');
    $('#offer_search_lat').hide();
    $('#offer_search_lng').hide();
    $("#offer_search_distance").attr("disabled", false);

    $("#offer_search_nearme").change(function() {
        let nearmeState = document.getElementById('offer_search_nearme').checked;
        let areaState = document.getElementById('offer_search_myArea').checked;
        if (nearmeState) {
            if (areaState) {
                $('#offer_search_myArea').bootstrapToggle('off');
            }
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_nearme', 'desactive');

            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(offer_showLocation);
            }else{
                let error_message = Translator.trans('Geolocation is not supported by this browser.');
                $('#offer_location').html(error_message);
            }
        } else {
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", false);
            localStorage.setItem('offer_nearme', 'active');
        }
    });*/

    /*if (nearMe === 'desactive') {
        $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", false);
        $("#offer_search_distance").attr("disabled", true);
    }
    else{
        let areaState = document.getElementById('offer_search_myArea').checked;
        $('#offer_search_nearme').bootstrapToggle('on');
        /!*$('#offer_search_nearme').prop('checked', true).change();*!/
        $("#offer_search_distance").attr("disabled", false);
        $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
        if (areaState) {
            $('#offer_search_myArea').bootstrapToggle('off');
        }
        localStorage.setItem('offer_nearme', 'active');
    }*/

});
//end test//

// offer search location
$(document).ready(function() {
    var nearme = localStorage.getItem('offer_nearme');
    $('#offer_search_lat').hide();
    $('#offer_search_lng').hide();
    $("#offer_search_distance").attr("disabled", true);

    $("#offer_search_nearme").click(function() {

        if ($('#offer_search_nearme').is(":checked")) {
            if ($('#offer_search_myArea').is(":checked")) {
                $("#offer_search_myArea").prop("checked", false);
            }
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", false);
            localStorage.setItem('offer_nearme', 'active');

            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(offer_showLocation);
            }else{
                let error_message = Translator.trans('Geolocation is not supported by this browser.');
                $('#offer_location').html(error_message);
            }
        } else {
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", false);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_nearme', 'desactive');
        }
    });
    if (nearme === 'active') {
        if ($('#offer_search_nearme').is(":checked")) {
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", false);
            if ($('#offer_search_myArea').is(":checked")) {
                $("#offer_search_myArea").prop("checked", false);
            }
        }
        else{
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", false);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_nearme', 'desactive');
        }
    }
});

function offer_showLocation(position){
    var data = {};
    data['lat']= position.coords.latitude;
    data['lng']= position.coords.longitude;

    var offer_url = Routing.generate('ajax_request');
    $.ajax({
        method: "post",
        dataType: "json",
        url: offer_url,
        async: true,
        data:data,
    }).done( function(data) {
        $('#offer_search_lat').val(data[0]);
        $('#offer_search_lng').val(data[1]);
    }).fail(function(jxh,textmsg,errorThrown){
        alert(textmsg);
        alert(errorThrown);
    });
}

//demand search location
$(document).ready(function() {
    var nearme = localStorage.getItem('demand_nearme');
    $('#demand_search_lat').hide();
    $('#demand_search_lng').hide();
    $("#demand_search_distance").attr("disabled", true);

    $("#demand_search_nearme").click(function() {

        if ($('#demand_search_nearme').is(":checked")) {

            if ($('#demand_search_myArea').is(":checked")) {
                $("#demand_search_myArea").prop("checked", false);
            }
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", true);
            $("#demand_search_distance").attr("disabled", false);
            localStorage.setItem('demand_nearme', 'active');

            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(demand_showLocation);
            }else{
                let error_message = Translator.trans('Geolocation is not supported by this browser.');
                $('#demand_location').html(error_message);
            }
        } else {
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", false);
            $("#demand_search_distance").attr("disabled", true);
            localStorage.setItem('demand_nearme', 'desactive');
        }
    });
    if (nearme === 'active') {
        if ($('#demand_search_nearme').is(":checked")) {
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", true);
            $("#demand_search_distance").attr("disabled", false);
            if ($('#demand_search_myArea').is(":checked")) {
                $("#demand_search_myArea").prop("checked", false);
            }
        }
        else{
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", false);
            $("#demand_search_distance").attr("disabled", true);
            localStorage.setItem('demand_nearme', 'desactive');
        }
    }
});

function demand_showLocation(position){
    var data = {};
    data['lat']= position.coords.latitude;
    data['lng']= position.coords.longitude;
    var demand_url = Routing.generate('ajax_request');

    $.ajax({
        method: "post",
        dataType: "json",
        url: demand_url,
        async: true,
        data:data,
    }).done( function(data) {
        $('#demand_search_lat').val(data[0]);
        $('#demand_search_lng').val(data[1]);
    }).fail(function(jxh,textmsg,errorThrown){
        alert(textmsg);
        alert(errorThrown);
    });
}



// search offer my area
$(document).ready(function() {
    var my_area = localStorage.getItem('offer_my_area');

    $("#offer_search_myArea").click(function() {

        if ($('#offer_search_myArea').is(":checked")) {

            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_my_area', 'active');

            if ($('#offer_search_nearme').is(":checked")) {
                $("#offer_search_nearme").prop("checked", false);
            }

        } else {
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", false);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_my_area', 'active');
        }
    });
    if (my_area === 'active') {
        if ($('#offer_search_myArea').is(":checked")) {

            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", true);
            $("#offer_search_distance").attr("disabled", true);

            if ($('#offer_search_nearme').is(":checked")) {
                $("#offer_search_nearme").prop("checked", false);
            }

        }
        else{
            $("#offer_search_region,#offer_search_department,#offer_search_ville").attr("disabled", false);
            $("#offer_search_distance").attr("disabled", true);
            localStorage.setItem('offer_my_area', 'desactive');
        }
    }
});

// search demand my area
$(document).ready(function() {
    var my_area = localStorage.getItem('demand_my_area');

    $("#demand_search_myArea").click(function() {

        if ($('#demand_search_myArea').is(":checked")) {

            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", true);
            $("#demand_search_distance").attr("disabled", true);
            localStorage.setItem('demand_my_area', 'active');

            if ($('#demand_search_nearme').is(":checked")) {
                $("#demand_search_nearme").prop("checked", false);
            }

        } else {
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", false);
            $("#demand_search_distance").attr("disabled", true);
            localStorage.setItem('demand_my_area', 'active');
        }
    });
    if (my_area === 'active') {
        if ($('#demand_search_myArea').is(":checked")) {

            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", true);
            $("#demand_search_distance").attr("disabled", true);

            if ($('#demand_search_nearme').is(":checked")) {
                $("#demand_search_nearme").prop("checked", false);
            }

        }
        else{
            $("#demand_search_region,#demand_search_department,#demand_search_ville").attr("disabled", false);
            $("#demand_search_distance").attr("disabled", true);
            localStorage.setItem('demand_my_area', 'desactive');
        }
    }
});
