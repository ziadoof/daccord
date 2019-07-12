
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

//ad_ search offer
$(document).on('change', '#offer_search_region', function () {
    let $field = $(this)
    let $regionField = $('#offer_search_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('region', 'department')
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
        $('#offer_search_ville').select2({
            placeholder: " Select department",
        });
    });
});
$(document).on('change', '#offer_search_department', function () {
    let $field = $(this)
    let $regionField = $('#offer_search_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department', 'ville')
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
        $(target).select2({
            placeholder: "City or zip code",
            tage: true,
            selectOnClose: true,
            maximumSelectionLength: 8,
            minimumResultsForSearch: 1,
            minimumInputLength: 2,
            selectOnBlur: true
        });
    });
});
$('#offer_search_ville').select2({
    placeholder: " Select region",
});

//end search offer


//end test

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
        $("#demand_search_ville").select2({
            placeholder: "ville ou postal code",
            tage: true,
            maximumSelectionLength: 6
        });
    });
});

