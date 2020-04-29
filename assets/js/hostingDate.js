import Translator from 'bazinga-translator';
// hosting read more
$(function() {

    var minimized_elements = $('p.minimize');

    minimized_elements.each(function() {
        var t = $(this).text();
        if (t.length < 200) return;

        let more = Translator.trans('More');
        let less = Translator.trans('Less');

        $(this).html(
            t.slice(0, 200) + '<span>... </span><a href="#" class="more">'+more+'</a>' +
            '<span style="display:none;">' + t.slice(100, t.length) + ' <a href="#" class="less">'+less+'</a></span>'
        );

    });

    $('a.more', minimized_elements).click(function(event) {
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();
    });

    $('a.less', minimized_elements).click(function(event) {
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();
    });

});

// hosting form
$('#hosting_languages').select2({

    placeholder: Translator.trans('Languages'),
    tage: true,
    maximumSelectionLength: 6,
    dropdownAutoWidth: true,
    width: '100%',
});


