
$(document).on('change', '#user_city_region, #user_city_department', function () {
    let $field = $(this)
    let $regionField = $('#user_city_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department', 'city').replace('region', 'department')
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

//ad_ search

$(document).on('change', '#offer_search_region, #offer_search_department', function () {
    let $field = $(this)
    let $regionField = $('#offer_search_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department', 'ville').replace('region', 'department')
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
$(document).on('change', '#demand_search_region, #demand_search_department', function () {
    let $field = $(this)
    let $regionField = $('#demand_search_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department', 'ville').replace('region', 'department')
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