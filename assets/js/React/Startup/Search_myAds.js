import React from 'react';
import ReactDOM from 'react-dom';
import ListsAds from "../Components/ListsAds";
import ListsHosting from "../Components/ListsHosting";
import ListsMeetup from "../Components/ListsMeetup";
import ListsVoyages from "../Components/ListsVoyages";
import Translator from "bazinga-translator";
import {generateSearchOfferSlide,generateSearchDemandSlide} from '../../generate_slider';

$('#search-offer').submit( function(e) {
    e.preventDefault();
    generateSearchOfferSlide();

    var url = Routing.generate('add-offerType');
    var formSerialize = $(this).serialize();

    //test//
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
    //end test//

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
    generateSearchDemandSlide();

    var url = Routing.generate('add-DemandType');
    var formSerialize = $(this).serialize();

    //test//
    let array1 = formSerialize.split("demand_search%5B");
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
    //end test//

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

