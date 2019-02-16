var $specification = $("#offer_category");
$(document).on('change', '#offer_category', function () {
    var $form = $(this).closest('form');
    var data = {};
    data[$specification.attr('name')] = $specification.val();
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
        }
    });
});