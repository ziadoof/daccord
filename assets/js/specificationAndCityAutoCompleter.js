import tail from './meetup/tail.datetime-full';
import Translator from "bazinga-translator";

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

            addSlider();
            hideElemants();
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


// add range slider for specification//
function addSlider() {

    if ($("#manufacturingYear-slider").is(":visible")){
        let idOptions = document.getElementById('offer_search_maxManufacturingYear').options;
        let firstYear = idOptions.length-1;
        let options =[parseInt(idOptions[firstYear].value)-1];
        for (let i=idOptions.length-1; i>0; i--) {
            options.push(parseInt(idOptions[i].value));
        }
        let last = options.length;
        let value = [options[0], options[last-1]];
        let manufacturingYear = new Slider("#manufacturingYear-slider", {
            min: options[0], max: options[last-1], value: value, focus: true
        });
    }
    if ($("#kilometrage-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxKilometer').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];
        let kilometrage = new Slider("#kilometrage-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#changeGear-slider").is(":visible")) {
        let all = Translator.trans("All");
        let auto = Translator.trans("Automatic");
        let man = Translator.trans("Manual");
        let id = document.getElementById('changeGear-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ auto+'","'+ man + '"]');
        let changeGear = new Slider('#changeGear-slider',{
       });
        $( ".change-gear" ).children().addClass("white");
    }
    if ($("#numberOfPassengers-slider").is(":visible")) {

        let numberOfPassengers = new Slider('#numberOfPassengers-slider',{
            min: 0,
            max: 48,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfDoors-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfDoors').options;
        let last = (idOptions.length)-1;
        let numberOfDoors = new Slider('#numberOfDoors-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#capacityMinMax-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxCapacity').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];

        let placeholder = $('#offer_search_minCapacity option:selected').text();
        let title = placeholder.substr(4);
        $("#minMaxCapacityOfferSearch").text(toTitleCase(title));
        let capacity = new Slider("#capacityMinMax-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#workHours-slider").is(":visible")) {
        let all = Translator.trans("All");
        let full = Translator.trans("Full");
        let partial = Translator.trans("Partial");
        let id = document.getElementById('workHours-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ full+'","'+ partial + '"]');
        let workHours = new Slider('#workHours-slider',{
        });
        $( ".workHoursOfferSearch" ).children().addClass("white");
    }
    if ($("#dvdCd-slider").is(":visible")) {
        let all = Translator.trans("All");
        let dvd = Translator.trans("DVD");
        let cd = Translator.trans("CD");
        let id = document.getElementById('dvdCd-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ dvd +'","'+ cd + '"]');
        let dvdCd = new Slider('#dvdCd-slider',{
        });
        $( ".dvdCdOfferSearch" ).children().addClass("white");
    }
    if ($("#ram-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_ram').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }

        let placeholder = $('#offer_search_ram option:selected').text();
        let title = placeholder.substr(4);
        $("#ramOfferSearch").text(toTitleCase(title));
        let ram = new Slider("#ram-slider", {
            ticks: Options,
            value:0
        });
    }
    if ($("#wifi-slider").is(":visible")) {
        let all = Translator.trans("All");
        let wifi = Translator.trans("Wifi");
        let id = document.getElementById('wifi-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ wifi + '"]');
        let slider = new Slider('#wifi-slider',{
        });
        $( ".wifiOfferSearch" ).children().addClass("white");
    }
    if ($("#accessories-slider").is(":visible")) {
        let all = Translator.trans("All");
        let accessories = Translator.trans("Accessories");
        let id = document.getElementById('accessories-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ accessories + '"]');
        let slider = new Slider('#accessories-slider',{
        });
        $( ".accessoriesOfferSearch" ).children().addClass("white");
    }
    if ($("#hdmi-slider").is(":visible")) {
        let all = Translator.trans("All");
        let hdmi = Translator.trans("Hdmi");
        let id = document.getElementById('hdmi-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ hdmi + '"]');
        let slider = new Slider('#hdmi-slider',{
        });
        $( ".hdmiOfferSearch" ).children().addClass("white");
    }
    if ($("#cdRoom-slider").is(":visible")) {
        let all = Translator.trans("All");
        let cdRoom = Translator.trans("Cd Room");
        let id = document.getElementById('cdRoom-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ cdRoom + '"]');
        let slider = new Slider('#cdRoom-slider',{
        });
        $( ".cdRoomOfferSearch" ).children().addClass("white");
    }
    if ($("#usb-slider").is(":visible")) {
        let all = Translator.trans("All");
        let usb = Translator.trans("Usb");
        let id = document.getElementById('usb-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ usb + '"]');
        let slider = new Slider('#usb-slider',{
        });
        $( ".usbOfferSearch" ).children().addClass("white");
    }
    if ($("#covered-slider").is(":visible")) {
        let all = Translator.trans("All");
        let covered = Translator.trans("Covered");
        let id = document.getElementById('covered-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ covered + '"]');
        let slider = new Slider('#covered-slider',{
        });
        $( ".coveredOfferSearch" ).children().addClass("white");
    }
    if ($("#electricHead-slider").is(":visible")) {
        let all = Translator.trans("All");
        let electricHead = Translator.trans("Electric Head");
        let id = document.getElementById('electricHead-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ electricHead + '"]');
        let slider = new Slider('#electricHead-slider',{
        });
        $( ".electricHeadOfferSearch" ).children().addClass("white");
    }
    if ($("#threeInOne-slider").is(":visible")) {
        let all = Translator.trans("All");
        let threeInOne = Translator.trans("Three In One");
        let id = document.getElementById('threeInOne-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ threeInOne + '"]');
        let slider = new Slider('#threeInOne-slider',{
        });
        $( ".threeInOneOfferSearch" ).children().addClass("white");
    }
    if ($("#Oven-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withOven = Translator.trans("With Oven");
        let id = document.getElementById('Oven-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withOven + '"]');
        let slider = new Slider('#Oven-slider',{
        });
        $( ".OvenOfferSearch" ).children().addClass("white");
    }
    if ($("#Elevator-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withElevator = Translator.trans("With Elevator");
        let id = document.getElementById('Elevator-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withElevator + '"]');
        let slider = new Slider('#Elevator-slider',{
        });
        $( ".ElevatorOfferSearch" ).children().addClass("white");
    }
    if ($("#Freezer-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withFreezer = Translator.trans("With Freezer");
        let id = document.getElementById('Freezer-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withFreezer + '"]');
        let slider = new Slider('#Freezer-slider',{
        });
        $( ".FreezerOfferSearch" ).children().addClass("white");
    }
    if ($("#Furniture-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Furniture = Translator.trans("With Furniture");
        let id = document.getElementById('Furniture-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Furniture + '"]');
        let slider = new Slider('#Furniture-slider',{
        });
        $( ".FurnitureOfferSearch" ).children().addClass("white");
    }
    if ($("#Garden-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Garden = Translator.trans("With Garden");
        let id = document.getElementById('Garden-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Garden + '"]');
        let slider = new Slider('#Garden-slider',{
        });
        $( ".GardenOfferSearch" ).children().addClass("white");
    }
    if ($("#Verandah-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Verandah = Translator.trans("With Verandah");
        let id = document.getElementById('Verandah-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Verandah + '"]');
        let slider = new Slider('#Verandah-slider',{
        });
        $( ".VerandahOfferSearch" ).children().addClass("white");
    }
    if ($("#numberOfHead-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfHead').options;
        let last = (idOptions.length)-1;
        let numberOfDoors = new Slider('#numberOfHead-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfPersson-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfPersson').options;
        let last = (idOptions.length)-1;
        let numberOfPersson = new Slider('#numberOfPersson-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#number-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_number').options;
        let last = (idOptions.length)-1;
        let numberOfPersson = new Slider('#number-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfRooms-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfRooms').options;
        let last = (idOptions.length)-1;
        let numberOfRooms = new Slider('#numberOfRooms-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#AreaMinMax-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxArea').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];

        let placeholder = $('#offer_search_minArea option:selected').text();
        let title = placeholder.substr(4);
        $("#minMaxAreaOfferSearch").text(toTitleCase(title));
        let area = new Slider("#AreaMinMax-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#classEnergie-slider").is(":visible")) {
        let id = document.getElementById('classEnergie-slider');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classEnergie = new Slider('#classEnergie-slider',{
        });
        $( ".classEnergieOfferSearch" ).children().addClass("white");
    }
    if ($("#classGes-slider").is(":visible")) {
        let id = document.getElementById('classGes-slider');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classGes = new Slider('#classGes-slider',{
        });
        $( ".classGesOfferSearch" ).children().addClass("white");
    }
    if ($("#numberOfDrawer-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfDrawer').options;
        let last = (idOptions.length)-1;
        let numberOfDrawer = new Slider('#numberOfDrawer-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfStaging-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfStaging').options;
        let last = (idOptions.length)-1;
        let numberOfStaging = new Slider('#numberOfStaging-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
}
function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}
function hideElemants() {
    let items = $('[id^="section"]');

    for (let i=3;i<items.length;i++){
        let id=$(items[i]).attr('id');
        $('#'+id).addClass('d-none');
    }
    let button= $('<div class="search-down"><a class="float-right" id="offer-more">\n' +
        '<i id="more-down" class="far fa-arrow-alt-circle-down mt-3 "></i>\n' +
        '</a></div>');
    $("#search_offer_dynamic").append(button);
    let button_status = 'down';

    $('#offer-more').on('click',function(){

        if(button_status === 'down'){
            $('#more-down').removeClass('fa-arrow-alt-circle-down');
            $('#more-down').addClass('fa-arrow-alt-circle-up');
            button_status = 'up';
        }
        else{
            $('#more-down').addClass('fa-arrow-alt-circle-down');
            $('#more-down').removeClass('fa-arrow-alt-circle-up');
            button_status = 'down';
        }

        for (let i=3;i<items.length;i++){
            let id=$(items[i]).attr('id');
            $('#'+id).toggleClass('d-none');
        }
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
