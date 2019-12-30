

const today = new Date();

function parseDMY(value) {
    var date = value.split("/");
    var d = parseInt(date[0], 10),
        m = parseInt(date[1], 10),
        y = parseInt(date[2], 10);
    return new Date(y, m - 1, d);
}

const dateOptionsDOE = {
    minDate: today,
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    onClose: function (selectedDate) {
        $("#hosting_request_startDate").datepicker("change", "maxDate", selectedDate);
    }
};
const dateOptionsDOB = {
    minDate: today,
    firstDay: 1,
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    onClose: function (selectedDate) {
        $("#hosting_request_endDate").datepicker("change", "minDate", selectedDate);
    }
};

$.validator.addMethod("dateGreaterThan",

    function (value, element, params) {
        var theDate = parseDMY(value);
        var paramDate = parseDMY($(params).val());
        if ($(params).val() === "") return true;

        if (!/Invalid|NaN/.test(theDate)) {
            return theDate > paramDate;
        }
        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
    }, 'Must be greater than {0}.');

$.validator.addMethod("dateLessThan",

    function (value, element, params) {
        var theDate = parseDMY(value);
        var paramDate = parseDMY($(params).val());
        if ($(params).val() === "") return true;

        if (!/Invalid|NaN/.test(theDate)) {
            return theDate < paramDate;
        }

        return isNaN(value) && isNaN($(params).val()) || (Number(value) < Number($(params).val()));
    }, 'Must be less than {0}.');

$(document).ready(function () {
    $("#hosting-request").validate({
        rules: {
            startDate: {
                required: true,
                dateFormat: "dd/mm/yy",
                dateITA: true,
                dateLessThan: '#hosting_request_endDate'
            },
            endDate: {
                required: true,
                dateFormat: "dd/mm/yy",
                dateITA: false,
                dateGreaterThan: "#hosting_request_startDate"
            }
        },
        onfocusout: function (element) {
            if ($(element).val()) {
                $(element).valid();
            }
        }
    });
    $("#hosting_request_endDate").datepicker($.extend({}, $.datepicker.regional['en-GB'], dateOptionsDOE));
    $("#hosting_request_startDate").datepicker($.extend({}, $.datepicker.regional['en-GB'], dateOptionsDOB));
});


// hosting read more

$(function() {

    var minimized_elements = $('p.minimize');

    minimized_elements.each(function() {
        var t = $(this).text();
        if (t.length < 200) return;

        $(this).html(
            t.slice(0, 200) + '<span>... </span><a href="#" class="more">More</a>' +
            '<span style="display:none;">' + t.slice(100, t.length) + ' <a href="#" class="less">Less</a></span>'
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
    placeholder: "Languages",
    tage: true,
    maximumSelectionLength: 6,
    dropdownAutoWidth: true,
    width: '100%',
});


