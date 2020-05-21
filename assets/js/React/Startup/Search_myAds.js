import React from 'react';
import ReactDOM from 'react-dom';
import ListsAds from "../Components/ListsAds";
import ListsHosting from "../Components/ListsHosting";
import ListsMeetup from "../Components/ListsMeetup";
import ListsVoyages from "../Components/ListsVoyages";
import Translator from "bazinga-translator";

$('#search-offer').submit( function(e) {
    e.preventDefault();
    generateSlide();

    var url = Routing.generate('add-offerType');
    var formSerialize = $(this).serialize();
    let array1 = formSerialize.split("offer_search%5B");
    let array2 = [];
    for (var i = 0; i < array1.length; i++) {
        if(array1[i]!==''){
            let string = array1[i].replace('%5D','');
            let string2 = string.replace('=',' = ');
            let string3 = string2.replace('&','');
            array2.push(string3);
        }
    }

    console.log(array2);
    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        let ext = response['random'];
        window.history.pushState( "","",'/search/offers/'+ext);
        $('#all').hide();
        ReactDOM.render(<ListsAds result={response['result']}/>, document.getElementById('searching'));
        setFavorite();
    }).fail(function(jxh,textmsg,errorThrown){
         alert(Translator.trans('Something went wrong during processing search for offers!'));
    });
});



$('#search-demand').submit( function(e) {
    e.preventDefault();

    var url = Routing.generate('add-DemandType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        let ext = response['random'];
        window.history.pushState( "","",'/search/demands/'+ext);
        $('#all').hide();
        ReactDOM.render(<ListsAds  result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
                 alert(Translator.trans('Something went wrong during processing search for demands!'));
    });
});

$(document).on('click', '#my_offer', function () {
    let url = Routing.generate('my_offers');
    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        data:{'type':'Offer'},
        async: true,
    }).done( function(response) {
        $('#all').hide();
        window.history.pushState("", "", '/my_ads/offers');
        ReactDOM.render(<ListsAds  result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
                 alert(Translator.trans('Something went wrong during processing your offers!'));
    });

});
$(document).on('click', '#my_demand', function () {
    let url = Routing.generate('my_demands');
    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:{'type':'Demand'},
    }).done( function(response) {
        $('#all').hide();
        window.history.pushState("", null, '/my_ads/demands');

        ReactDOM.render(<ListsAds  result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
                 alert(Translator.trans('Something went wrong during processing your demands!'));
    });

});

window.addEventListener('popstate', function(e) {
        window.location.reload();
});

$('#search-hosting').submit( function(e) {
    e.preventDefault();
    var url = Routing.generate('add-hostingType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        let ext = response['random'];
        window.history.pushState( "","",'/search/hosting/'+ext);
        $('#all').hide();
        ReactDOM.render(<ListsHosting result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
        alert(Translator.trans('Something went wrong during processing search for hosting!'));
    });
});

$('#search-meetup').submit( function(e) {
    e.preventDefault();
    var url = Routing.generate('add-meetupType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        let ext = response['random'];
        window.history.pushState( "","",'/search/meetup/'+ext);
        $('#all').hide();
        ReactDOM.render(<ListsMeetup result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
        alert(Translator.trans('Something went wrong during processing search for meetup!'));
    });
});

$('#search-carpooling').submit( function(e) {
    e.preventDefault();
    var url = Routing.generate('add-voyageType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        let ext = response['random'];
        window.history.pushState( "","",'/search/carpooling/'+ext);
        $('#all').hide();
        ReactDOM.render(<ListsVoyages result={response['result']}/>, document.getElementById('searching'));
        setFavorite();

    }).fail(function(jxh,textmsg,errorThrown){
        alert(Translator.trans('Something went wrong during processing search for voyage!'));
    });
});

function setFavorite() {

    var favoriteAdd = document.getElementsByClassName('js-favorite-add');
    for (var favorite of favoriteAdd) {
        favorite.addEventListener('click', function (e) {
            $(this.querySelector('span')).toggleClass('active');
            e.preventDefault();
            let object = this.getAttribute('data-object');
            let type = this.getAttribute('data-type');
            let isFavorite = this.getAttribute('data-favorite');
            let data = {object, type};
            let url = '';
            if (isFavorite === 'true') {
                url = Routing.generate('favorite_remove');
                $(this).attr('data-favorite', 'false');
            } else {
                url = Routing.generate('favorite_add');
                $(this).attr('data-favorite', 'true');
            }

            $.ajax({
                method: "post",
                dataType: "json",
                url: url,
                data: data,
            }).done(function (response) {
            })


        })
    }
}

function generateSlide() {
    if ($("#manufacturingYear-slider").length>0){
        let manufacturingYear_value = document.getElementById('manufacturingYear-slider').value;
        let value = manufacturingYear_value.split(",");

        $('#offer_search_minManufacturingYear option:selected').removeAttr('selected');
        $('#offer_search_maxManufacturingYear option:selected').removeAttr('selected');
        $("#offer_search_minManufacturingYear option[value=" + parseInt(value[0]) +"]").attr("selected","selected");
        $("#offer_search_maxManufacturingYear option[value=" + parseInt(value[1]) +"]").attr("selected","selected");
    }
    if ($("#kilometrage-slider").length>0) {
        let kilometrage_value = document.getElementById('kilometrage-slider').value;
        let value = kilometrage_value.split(",");
        $('#offer_search_minKilometer option:selected').removeAttr('selected');
        $('#offer_search_maxKilometer option:selected').removeAttr('selected');
        if(parseInt(value[1])===300000){
            if(parseInt(value[0])===0){
                $("#offer_search_minKilometer")[0].selectedIndex = -1;
                $("#offer_search_maxKilometer")[0].selectedIndex = -1;
            }
            else {
                $("#offer_search_minKilometer option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
                $("#offer_search_maxKilometer")[0].selectedIndex = -1;
            }
        }
        else{
            $("#offer_search_minKilometer option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
            $("#offer_search_maxKilometer option[value=" + parseInt(value[1]) + "]").attr("selected", "selected");
        }
    }
    if ($("#changeGear-slider").length>0) {
        let changeGear_value = document.getElementById('changeGear-slider').value;
        let valueArray= [null,'Automatic', 'Manual'];
        let value = valueArray[changeGear_value];
        $('#offer_search_changeGear option:selected').removeAttr('selected');
        $("#offer_search_changeGear option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#numberOfPassengers-slider").length>0) {
        let numberOfPassengers_value = document.getElementById('numberOfPassengers-slider').value;
        $('#offer_search_numberOfPassengers option:selected').removeAttr('selected');
        if(numberOfPassengers_value >0){
            $("#offer_search_numberOfPassengers option[value=" + parseInt(numberOfPassengers_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfPassengers")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfDoors-slider").length>0) {
        let numberOfDoors_value = document.getElementById('numberOfDoors-slider').value;
        $('#offer_search_numberOfDoors option:selected').removeAttr('selected');
        if(numberOfDoors_value >0){
            $("#offer_search_numberOfDoors option[value=" + parseInt(numberOfDoors_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfDoors")[0].selectedIndex = -1;
        }
    }
    if ($("#capacityMinMax-slider").length>0) {
        let capacity_value = document.getElementById('capacityMinMax-slider').value;
        let value = capacity_value.split(",");
        $('#offer_search_minCapacity option:selected').removeAttr('selected');
        $('#offer_search_maxCapacity option:selected').removeAttr('selected');
        $("#offer_search_minCapacity option[value=" + parseInt(value[0]) +"]").attr("selected", "selected");
        $("#offer_search_maxCapacity option[value=" + parseInt(value[1]) +"]").attr("selected", "selected");
    }
    if ($("#workHours-slider").length>0) {
        let workHours_value = document.getElementById('workHours-slider').value;
        let valueArray= [null,'Full', 'Partial'];
        let value = valueArray[workHours_value];
        $('#offer_search_workHours option:selected').removeAttr('selected');
        $("#offer_search_workHours option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#dvdCd-slider").length>0) {
        let dvdCd_value = document.getElementById('dvdCd-slider').value;
        let valueArray= [null,'DVD', 'CD'];
        let value = valueArray[dvdCd_value];
        $('#offer_search_dvdCd option:selected').removeAttr('selected');
        $("#offer_search_dvdCd option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#ram-slider").length>0) {
        let ram_value = document.getElementById('ram-slider').value;
        $('#offer_search_ram option:selected').removeAttr('selected');
        if(ram_value >0){
            $("#offer_search_ram option[value=" + parseInt(ram_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_ram")[0].selectedIndex = -1;
        }
    }
    if ($("#wifi-slider").length>0) {
        let wifi_value = document.getElementById('wifi-slider').value;
        $('#offer_search_wifi')[0].checked = wifi_value === '1';
    }
    if ($("#accessories-slider").length>0) {
        let value = document.getElementById('accessories-slider').value;
        $('#offer_search_accessories')[0].checked = value === '1';
    }
    if ($("#hdmi-slider").length>0) {
        let value = document.getElementById('hdmi-slider').value;
        $('#offer_search_hdmi')[0].checked = value === '1';
    }
    if ($("#cdRoom-slider").length>0) {
        let value = document.getElementById('cdRoom-slider').value;
        $('#offer_search_cdRoom')[0].checked = value === '1';
    }
    if ($("#usb-slider").length>0) {
        let value = document.getElementById('usb-slider').value;
        $('#offer_search_usb')[0].checked = value === '1';
    }
    if ($("#covered-slider").length>0) {
        let value = document.getElementById('covered-slider').value;
        $('#offer_search_covered')[0].checked = value === '1';
    }
    if ($("#electricHead-slider").length>0) {
        let value = document.getElementById('electricHead-slider').value;
        $('#offer_search_electricHead')[0].checked = value === '1';
    }
    if ($("#threeInOne-slider").length>0) {
        let value = document.getElementById('threeInOne-slider').value;
        $('#offer_search_threeInOne')[0].checked = value === '1';
    }
    if ($("#Oven-slider").length>0) {
        let value = document.getElementById('Oven-slider').value;
        $('#offer_search_withOven')[0].checked = value === '1';
    }
    if ($("#Elevator-slider").length>0) {
        let value = document.getElementById('Elevator-slider').value;
        $('#offer_search_withElevator')[0].checked = value === '1';
    }
    if ($("#Freezer-slider").length>0) {
        let value = document.getElementById('Freezer-slider').value;
        $('#offer_search_withFreezer')[0].checked = value === '1';
    }
    if ($("#Furniture-slider").length>0) {
        let value = document.getElementById('Furniture-slider').value;
        $('#offer_search_withFurniture')[0].checked = value === '1';
    }
    if ($("#Garden-slider").length>0) {
        let value = document.getElementById('Garden-slider').value;
        $('#offer_search_withGarden')[0].checked = value === '1';
    }
    if ($("#Verandah-slider").length>0) {
        let value = document.getElementById('Verandah-slider').value;
        $('#offer_search_withVerandah')[0].checked = value === '1';
    }
    if ($("#numberOfHead-slider").length>0) {
        let numberOfHead_value = document.getElementById('numberOfHead-slider').value;
        $('#offer_search_numberOfHead option:selected').removeAttr('selected');
        if(numberOfHead_value >0){
            $("#offer_search_numberOfHead option[value=" + parseInt(numberOfHead_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfHead")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfPersson-slider").length>0) {
        let numberOfPersson_value = document.getElementById('numberOfPersson-slider').value;
        $('#offer_search_numberOfPersson option:selected').removeAttr('selected');
        if(numberOfPersson_value >0){
            $("#offer_search_numberOfPersson option[value=" + parseInt(numberOfPersson_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfPersson")[0].selectedIndex = -1;
        }
    }
    if ($("#number-slider").length>0) {
        let number_value = document.getElementById('number-slider').value;
        $('#offer_search_number option:selected').removeAttr('selected');
        if(number_value >0){
            $("#offer_search_number option[value=" + parseInt(number_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_number")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfRooms-slider").length>0) {
        let numberOfRooms_value = document.getElementById('numberOfRooms-slider').value;
        $('#offer_search_numberOfRooms option:selected').removeAttr('selected');
        if(numberOfRooms_value >0){
            $("#offer_search_numberOfRooms option[value=" + parseInt(numberOfRooms_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfRooms")[0].selectedIndex = -1;
        }
    }
    if ($("#AreaMinMax-slider").length>0) {
        let area_value = document.getElementById('AreaMinMax-slider').value;
        let value = area_value.split(",");
        let idOptions = document.getElementById('offer_search_maxArea').options;
        let last = idOptions.length;
        let max = idOptions[last-1].value;
        $('#offer_search_minArea option:selected').removeAttr('selected');
        $('#offer_search_maxArea option:selected').removeAttr('selected');
        if(parseInt(value[1])=== parseInt(max)){
            if(parseInt(value[0])===0){
                $("#offer_search_minArea")[0].selectedIndex = -1;
                $("#offer_search_maxArea")[0].selectedIndex = -1;
            }
            else {
                $("#offer_search_minArea option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
                $("#offer_search_maxArea")[0].selectedIndex = -1;
            }
        }
        else{
            $("#offer_search_minArea option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
            $("#offer_search_maxArea option[value=" + parseInt(value[1]) + "]").attr("selected", "selected");
        }
    }
    if ($("#classEnergie-slider").length>0) {
        let classEnergie_value = document.getElementById('classEnergie-slider').value;
        $('#offer_search_classEnergie option:selected').removeAttr('selected');
        if(classEnergie_value>0){
            $("#offer_search_classEnergie option[value=" + classEnergie_value +"]").attr("selected", "selected");
        }
    }
    if ($("#classGes-slider").length>0) {
        let classGes_value = document.getElementById('classGes-slider').value;
        $('#offer_search_ges option:selected').removeAttr('selected');
        if(classGes_value>0){
            $("#offer_search_ges option[value=" + classGes_value +"]").attr("selected", "selected");
        }
    }
    if ($("#numberOfDrawer-slider").length>0) {
        let numberOfDrawer_value = document.getElementById('numberOfDrawer-slider').value;
        $('#offer_search_numberOfDrawer option:selected').removeAttr('selected');

        if(numberOfDrawer_value >0){
            $("#offer_search_numberOfDrawer option[value=" + parseInt(numberOfDrawer_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfDrawer")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfStaging-slider").length>0) {
        let numberOfStaging_value = document.getElementById('numberOfStaging-slider').value;
        $('#offer_search_numberOfStaging option:selected').removeAttr('selected');

        if(numberOfStaging_value >0){
            $("#offer_search_numberOfStaging option[value=" + parseInt(numberOfStaging_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfStaging")[0].selectedIndex = -1;
        }
    }


}