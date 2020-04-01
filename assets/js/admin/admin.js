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
