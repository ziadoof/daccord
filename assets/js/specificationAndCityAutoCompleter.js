import tail from './meetup/tail.datetime-full';
import Translator from "bazinga-translator";
import {addOfferSearchSlider,hideElementsOfferSearch, addDemandSearchSlider,hideElementsDemandSearch} from './slider';

/*this file grouped th specification for new ad  & city auto complete for form & template for dateTime offer and demand and other*/
var $ospecification = $("#offer_category");
$(document).on('change', '#offer_category', function () {
    var $form = $(this).closest('form');
    var data = {};
    data[$ospecification.attr('name')] = $ospecification.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
            var $dynamicForm = $(html).find('#new_form_dynamic');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item)
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#new_form_dynamic').replaceWith($dynamicForm);
            addBootstrapToggle('offer');
            $('#offer_languages').select2({
                placeholder: Translator.trans("Select languages"),
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });
            completeNormalCity('#offer_city');
            addDateTimeForm('#offer_dateOfEvent');
        }
    });
});
var $dspecification = $("#demand_category");
$(document).on('change', '#demand_category', function () {
    var $form = $(this).closest('form');
    var data = {};
    data[$dspecification.attr('name')] = $dspecification.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
            var $dynamicForm = $(html).find('#new_form_dynamic');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item)
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#new_form_dynamic').replaceWith($dynamicForm);
            addBootstrapToggle('demand');
            $('#demand_languages').select2({
                placeholder: Translator.trans("Select languages"),
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });
            completeNormalCity('#demand_city');
        }
    });
});

var $dsearch_specification = $("#demand_search_category");
$(document).on('change', '#demand_search_category', function () {
    var $form = $(this).closest('form');
    var data = {};
    data[$dsearch_specification.attr('name')] = $dsearch_specification.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
            var $dynamicForm = $(html).find('#search_demand_dynamic');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item);
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#search_demand_dynamic').replaceWith($dynamicForm);
            addBootstrapToggle('demand_search');
            $('#demand_search_languages').select2({
                placeholder: Translator.trans("Select languages"),
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });
            addDemandSearchSlider();
            hideElementsDemandSearch();
        }
    });
});

var $osearch_specification = $("#offer_search_category");
$(document).on('change', '#offer_search_category', function () {
    var $form = $(this).closest('form');
    var data = {};
    data[$osearch_specification.attr('name')] = $osearch_specification.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
            var $dynamicForm = $(html).find('#search_offer_dynamic');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item);
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#search_offer_dynamic').replaceWith($dynamicForm);
            addBootstrapToggle('offer_search');
            $('#offer_search_languages').select2({
                placeholder: Translator.trans("Select languages"),
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });

            addOfferSearchSlider();
            hideElementsOfferSearch();
        }
    });
});
donate('offer_search');
donate('offer');
donate('demand');

var $checkbox = [/*'accessories','cdRoom', 'covered', 'electricHead', 'hdmi', 'threeInOne', 'usb',
    'withOven', 'wifi', 'withElevator', 'withFreezer', 'withFurniture', 'withGarden', 'withVerandah', 'withDriver','donate'*/];


function addBootstrapToggle($type) {
    for (var i=0, total = $checkbox.length; i < total; i++) {
        $('#'+ $type +'_'+$checkbox[i]).bootstrapToggle();
    }
}

function donate($type) {
    $(document).on('change', '#'+$type+'_donate', function () {
        document.getElementById($type+'_price').disabled = this.checked;
    });
}

$(document).ready(function () {
    $('#offer_search_languages').select2({
        placeholder: Translator.trans("Select languages"),
    });
    $('#demand_search_languages').select2({
        placeholder: Translator.trans("Select languages"),
    });
    $('#offer_languages').select2({
        placeholder: Translator.trans("Select languages"),
    });
    $('#demand_languages').select2({
        placeholder: Translator.trans("Select languages"),
    });
    $('.select2-search__field').css('width', '100%');
});

$(document).ready(function () {
    completeNormalCity('#auto_area_city');
    completeNormalCity('#meetup_city');
    addBirthdayForm('#fos_user_profile_form_birthday');
});

function completeNormalCity(id) {
    let makeSelect = false;
    let $this = $(id), $fakeInput = $this.clone();
    $fakeInput.attr('id', 'fake_' + $fakeInput.attr('id'));
    $fakeInput.attr('name', 'fake_' + $fakeInput.attr('name'));
    $this.hide().after($fakeInput);
    $fakeInput.autocomplete({
        source: $('#url-list').attr('href'),
        autoFocus: true,
        minLength:2,
        theme: 'bootstrap',
        formatNoMatches: Translator.trans('No city found.'),
        formatSearching: Translator.trans('Searching city...'),
        formatInputTooShort: Translator.trans('Insert at least 2 character'),
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

function addDateTimeForm($id){
        tail.DateTime($id,{
            locale: Translator.locale,
            time12h: false,
            timeSeconds: null,
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
}

function addBirthdayForm($id){
    tail.DateTime($id,{
        locale: Translator.locale,
        time12h: false,
        timeSeconds: null,
        weekStart: 1,
        startOpen: false,
        stayOpen: false,
        dateFormat: "YYYY-mm-dd",
        timeFormat: false,
        zeroSeconds: false,
        today: true,
        closeButton:false,
    });
}

$('#more-localisation').on('click',function(){
    let status = $('#localisation');
    if(status.hasClass('show')){
        $('#more-localisation i').removeClass('fa-arrow-alt-circle-up');
        $('#more-localisation i').addClass('fa-arrow-alt-circle-down');
    }
    else {
        $('#more-localisation i').removeClass('fa-arrow-alt-circle-down');
        $('#more-localisation i').addClass('fa-arrow-alt-circle-up');
    }
});
$('#more-localisation-demand').on('click',function(){
    let status = $('#localisation-demand');
    if(status.hasClass('show')){
        $('#more-localisation-demand i').removeClass('fa-arrow-alt-circle-up');
        $('#more-localisation-demand i').addClass('fa-arrow-alt-circle-down');
    }
    else {
        $('#more-localisation-demand i').removeClass('fa-arrow-alt-circle-down');
        $('#more-localisation-demand i').addClass('fa-arrow-alt-circle-up');
    }
});
