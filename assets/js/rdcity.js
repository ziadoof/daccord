
$(document).on('change', '#area_region, #area_department', function () {
    let $field = $(this)
    let $regionField = $('#area_region')
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


// ad_search demand
$(document).on('change', '#demand_search_region', function () {
    let $field = $(this)
    let $regionField = $('#demand_search_region')
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
        $('#demand_search_ville').select2({
            placeholder: " Select department",
        });
    });
});
$(document).on('change', '#demand_search_department', function () {
    let $field = $(this)
    let $regionField = $('#demand_search_region')
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
//end search demand


//ad_ search offer
$(document).on('change', '#offer_search_region', function () {
    let $field = $(this)// #offer_search_region
    let $regionField = $('#offer_search_region')
    let $form = $field.closest('form')//form #search-offer

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

//end search offer

// fonction for placeholder on load the search page

$(document).ready(function () {
    $('#offer_search_ville').select2({
        placeholder: " Select region",
    });
    $('#demand_search_ville').select2({
        placeholder: " Select region",
        dropdownAutoWidth: true,
        width: '100%',
        height: '30px',
    });
    $('#hosting_search_ville').select2({
        placeholder: " Select region",
        dropdownAutoWidth: true,
        width: '100%',
        height: '30px',
    });
    $('.select2-search__field').css('width', '100%');
});

//search hosting
$(document).on('change', '#hosting_search_region', function () {
    let $field = $(this)// #hosting_search_region
    let $regionField = $('#hosting_search_region')
    let $form = $field.closest('form')//form #search-hosting
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
        $('#hosting_search_ville').select2({
            placeholder: " Select department",
        });
    });
});
$(document).on('change', '#hosting_search_department', function () {
    let $field = $(this)
    let $regionField = $('#hosting_search_region')
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

$(document).on('change', '#meetup_search_region', function () {
    let $field = $(this)
    let $regionField = $('#meetup_search_region')
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
        $('#meetup_search_city').select2({
            placeholder: " Select department",
        });
    });
});
$(document).on('change', '#meetup_search_department', function () {
    let $field = $(this)
    let $regionField = $('#meetup_search_region')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department', 'city')
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

$('#hosting_search_languages').select2({
    placeholder: "Languages",
    tage: true,
    maximumSelectionLength: 6,
    dropdownAutoWidth: true,
    width: '100%',
});






