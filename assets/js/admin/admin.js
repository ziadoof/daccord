var NOCollection = -1;
$('.specification-form').collection({
    add:'<a href="#" class="collection-add btn btn-info mb-4"><i class="fas fa-plus"></i> Add specification </a>',
    up:false,
    down:false,
    max: 14,
    min:0,

    after_add: function(collection, element) {
        NOCollection ++;

        let nameId = '#category_specification_specifications_'+NOCollection+'_name';
        let typeId = '#category_specification_specifications_'+NOCollection+'_type';
        let typeOfChoiceId = '#category_specification_specifications_'+NOCollection+'_typeOfChoice';

        $(document).on('change', nameId, function () {
            let $field = $(this);
            let $nameField = $(nameId);
            let $form = $field.closest('form');

            let target = '#' + $field.attr('id').replace('name', 'type');
            // Les données à envoyer en Ajax
            let data = {};
            data[$nameField.attr('name')] = $nameField.val();
            data[$field.attr('name')] = $field.val();
            // On soumet les données

            $.post($form.attr('action'), data).then(function (data) {
                // On récupère le nouveau <select>
                let $input = $(data).find(target);
                // On remplace notre <select> actuel
                $(target).replaceWith($input);
            });
        });

        $(document).on('change', typeId, function () {
            let $field = $(this);
            let $typeField = $(nameId);
            let $form = $field.closest('form');
            let target = '#' + $field.attr('id').replace('type', 'typeOfChoice');
            // Les données à envoyer en Ajax
            let data = {};
            data[$typeField.attr('name')] = $typeField.val();
            data[$field.attr('name')] = $field.val();
            // On soumet les données

            $.post($form.attr('action'), data).then(function (data) {
                // On récupère le nouveau <select>
                let $input = $(data).find(target);
                // On remplace notre <select> actuel
                $(target).replaceWith($input);
            });
        });

        $(document).on('change', typeOfChoiceId, function () {
            let $optionsTypeAdmin = $(typeOfChoiceId);

            let $form = $(this).closest('form');
            let data = {};
            data[$optionsTypeAdmin.attr('name')] = $optionsTypeAdmin.val();
            // Submit data via AJAX to the form's action path.
            $.ajax({
                url : $form.attr('action'),
                type: $form.attr('method'),
                data : data,
                success: function(html) {
                    var $dynamicForm = $(html).find('#dynamic-options');
                    $dynamicForm.children(".form-group").each(function (index, item){
                        var $item = $(item);
                        $item.removeClass('has-error');
                        $item.find(".help-block").remove();
                    });
                    $(element[0].querySelector('#dynamic-options')).replaceWith($dynamicForm);
                }

            });
        });

    },
    add_at_the_end: true,
});
$(document).ready(function() {
    let makeSelect = false;

    let $this = $('#user_city'), $fakeInput = $this.clone();
    $fakeInput.attr('id', 'fake_' + $fakeInput.attr('id'));
    $fakeInput.attr('name', 'fake_' + $fakeInput.attr('name'));
    $this.hide().after($fakeInput);
    let input = document.getElementById('fake_user_city');
    let div = input.parentNode;
    $(div).addClass('ui-front');

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
});