//autocomplate city in new meetup form
$(document).on('click', "#meetup_city",function () {
        'use strict';
        /* autocomplete city on new user (this is the main feature) */
        (function () {
            var options = {
                url_list: $('#url-list').attr('href'),
                url_get: $('#url-get').attr('href'),
                otherOptions: {
                    minimumInputLength: 2,
                    theme: 'boostrap',
                    formatNoMatches: Translator.trans('No city found.'),
                    formatSearching: Translator.trans('Searching city...'),
                    formatInputTooShort: Translator.trans('Insert at least 2 character'),
                }
            };
            $('#meetup_city').autocompleter(options);
        }());
    });