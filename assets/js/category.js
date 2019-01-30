
$(document).on('change', '#ad_category, #ad_sous', function () {
    let $field = $(this)
    let $regionField = $('#ad_category')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('sous', 'cato').replace('category', 'sous')
    // Les données à envoyer en Ajax
    let data = {}
    data[$regionField.attr('name')] = $regionField.val()
    data[$field.attr('name')] = $field.val()
    // On soumet les données
    $.post($form.attr('action'), data).then(function (data) {
        // On récupère le nouveau <select>
        let $input = $(data).find(target)
        // On remplace notre <select> actuel
        $(target).replaceWith($input)
    })

});
