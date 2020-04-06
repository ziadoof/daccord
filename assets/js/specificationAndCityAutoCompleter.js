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
                placeholder: " Select languages",
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });
            completeNormalCity('#offer_city');
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
                placeholder: " Select languages",
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
                placeholder: " Select languages",
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
                placeholder: " Select languages",
                tage: true,
                maximumSelectionLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
            });
        }
    });
});
donate('offer_search');
donate('offer');
donate('demand');

var $checkbox = ['accessories','cdRoom', 'covered', 'electricHead', 'hdmi', 'threeInOne', 'usb',
    'withOven', 'wifi', 'withElevator', 'withFreezer', 'withFurniture', 'withGarden', 'withVerandah', 'withDriver','donate'];


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
        placeholder: " Select languages",
    });
    $('#demand_search_languages').select2({
        placeholder: " Select languages",
    });
    $('#offer_languages').select2({
        placeholder: " Select languages",
    });
    $('#demand_languages').select2({
        placeholder: " Select languages",
    });
    $('.select2-search__field').css('width', '100%');
});

$(document).ready(function () {
    completeNormalCity('#auto_area_city');
    completeNormalCity('#meetup_city');
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
