$(document).ready(function () {
    completeCity('#voyage_search_mainDeparture');
    completeCity('#voyage_search_mainArrival');
});

function completeCity(id) {
    let makeSelect = false;
    let $this = $(id), $fakeInput = $this.clone();
    $fakeInput.attr('id', 'fake_' + $fakeInput.attr('id'));
    $fakeInput.attr('name', 'fake_' + $fakeInput.attr('name'));
    $this.hide().after($fakeInput);
    $fakeInput.autocomplete({
        source: $('#url-one-list').attr('href'),
        autoFocus: true,
        minLength:2,
        theme: 'bootstrap',
        formatNoMatches: 'No city found.',
        formatSearching: 'Searching city...',
        formatInputTooShort: 'Insert at least 2 character',
        close: function(e, ui) {
            if (!makeSelect) {
                $this.val(false);
            }
        },
        response:function( event, ui ){
            if (!makeSelect) {
                $this.val(false);
            }
        },
        focus: function(event, ui) {
            event.preventDefault();
            $this.val(ui.item.label);
        },
        select: function (event, ui) {
            event.preventDefault();
            makeSelect = true;
            $this.val(ui.item.value);
            $(this).val(ui.item.label);
        },

    });

}

document.addEventListener("DOMContentLoaded", function(){

    tail.DateTime("#voyage_search_date",{
        locale: "fr",
        weekStart: 1,
        startOpen: false,
        stayOpen: false,
        dateFormat: "YYYY-mm-dd",
        timeFormat: false,
        zeroSeconds: false,
        today: true,
        closeButton:false,
        dateStart:  new Date()

    });
});

