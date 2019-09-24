import React from 'react';
import ReactDOM from 'react-dom';
import ListsAds from "../Components/ListsAds";

$('#search-offer').submit( function(e) {
    e.preventDefault();
    var url = Routing.generate('add-offerType');
    var formSerialize = $(this).serialize();

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

    }).fail(function(jxh,textmsg,errorThrown){
         alert('Something went wrong during processing search for offers!');
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

    }).fail(function(jxh,textmsg,errorThrown){
                 alert('Something went wrong during processing search for demands!');
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
    }).fail(function(jxh,textmsg,errorThrown){
                 alert('Something went wrong during processing your offers!');
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
    }).fail(function(jxh,textmsg,errorThrown){
                 alert('Something went wrong during processing your demands!');
    });

});

window.addEventListener('popstate', function(e) {
        window.location.reload();
});