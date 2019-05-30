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
            var $dynamicForm = $(html).find('#dynamic_form');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item)
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#dynamic_form').replaceWith($dynamicForm);
            addBootstrapToggle('offer');
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
            var $dynamicForm = $(html).find('#dynamic_form');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item)
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#dynamic_form').replaceWith($dynamicForm);
            addBootstrapToggle('demand');
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
            var $dynamicForm = $(html).find('#demand_dynamic_form');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item);
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#demand_dynamic_form').replaceWith($dynamicForm);
            addBootstrapToggle('demand_search');

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
            var $dynamicForm = $(html).find('#dynamic_form');
            $dynamicForm.children(".form-group").each(function (index, item){
                var $item = $(item);
                $item.removeClass('has-error');
                $item.find(".help-block").remove();
            });
            $('#dynamic_form').replaceWith($dynamicForm);
            addBootstrapToggle('offer_search');

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

