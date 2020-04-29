import tail from './tail.datetime-full';
import Translator from "bazinga-translator";
/*date time form for hosting request and new meetup*/
//------------------------------------//
document.addEventListener("DOMContentLoaded", function(){

    tail.DateTime("#meetup_startAt",{
        locale: Translator.locale,
        time12h: false,
        timeSeconds: null,
        weekStart: 1,
        startOpen: false,
        stayOpen: false,
        dateFormat: "YYYY-mm-dd",
        timeFormat: "HH:ii",
        zeroSeconds: false,
        today: true,
        closeButton:false,
        dateStart:  new Date()
    });
    tail.DateTime("#meetup_endAt",{
        locale: Translator.locale,
        time12h: false,
        timeSeconds:null,
        weekStart:1,
        startOpen: false,
        stayOpen: false,
        dateFormat: "YYYY-mm-dd",
        timeFormat: "HH:ii",
        zeroSeconds: false,
        today: true,
        closeButton:false,
        dateStart: new Date(),

    });

    $("#meetup_startAt").on('change',function () {
        tail.DateTime("#meetup_endAt").remove();

        tail.DateTime("#meetup_endAt",{
            locale: Translator.locale,
            time12h: false,
            timeSeconds:null,
            weekStart:1,
            startOpen: false,
            stayOpen: false,
            dateFormat: "YYYY-mm-dd",
            timeFormat: "HH:ii",
            zeroSeconds: false,
            today: true,
            closeButton:false,
            dateStart: new Date($('#meetup_startAt').val()).getTime(),

        });
    });
    $("#meetup_endAt").on('change',function () {
        tail.DateTime("#meetup_startAt").remove();

        tail.DateTime("#meetup_startAt",{
            locale: Translator.locale,
            time12h: false,
            timeSeconds: null,
            weekStart: 1,
            startOpen: false,
            stayOpen: false,
            dateFormat: "YYYY-mm-dd",
            timeFormat: "HH:ii",
            zeroSeconds: false,
            today: true,
            closeButton:false,
            dateEnd: new Date($('#meetup_endAt').val()).getTime()
        });
    });


});

/*--------------*/
document.addEventListener("DOMContentLoaded", function(){

        tail.DateTime("#hosting_request_startDate",{
            locale: Translator.locale,
            time12h: false,
            timeSeconds: null,
            weekStart: 1,
            startOpen: false,
            stayOpen: false,
            dateFormat: "YYYY-mm-dd",
            timeFormat: false,
            zeroSeconds: false,
            today: true,
            closeButton:false,
            dateStart:  new Date()
        });

        tail.DateTime("#hosting_request_endDate",{
            locale: Translator.locale,
            time12h: false,
            timeSeconds:null,
            weekStart:1,
            startOpen: false,
            stayOpen: false,
            dateFormat: "YYYY-mm-dd",
            timeFormat: false,
            zeroSeconds: false,
            today: true,
            closeButton:false,
            dateStart: new Date(),

        });

        $("#hosting_request_startDate").on('change',function () {

            tail.DateTime("#hosting_request_endDate").remove();

            tail.DateTime("#hosting_request_endDate",{
                locale: Translator.locale,
                time12h: false,
                timeSeconds:null,
                weekStart:1,
                startOpen: false,
                stayOpen: false,
                dateFormat: "YYYY-mm-dd",
                timeFormat: false,
                zeroSeconds: false,
                today: true,
                closeButton:false,
                dateStart: new Date($('#hosting_request_startDate').val()).getTime(),

            });
        });
        $("#hosting_request_endDate").on('change',function () {
            tail.DateTime("#hosting_request_startDate").remove();

            tail.DateTime("#hosting_request_startDate",{
                locale: Translator.locale,
                time12h: false,
                timeSeconds: null,
                weekStart: 1,
                startOpen: false,
                stayOpen: false,
                dateFormat: "YYYY-mm-dd",
                timeFormat: false,
                zeroSeconds: false,
                today: true,
                closeButton:false,
                dateEnd: new Date($('#hosting_request_endDate').val()).getTime()
            });
        });

    });




$(document).ready(function () {

    function parseDMYHI(value) {
        var dateTime =  value.split(" ");
        var date = dateTime[0].split("-");
        var time = dateTime[1].split(":");

        var y = parseInt(date[0], 10),
            m = parseInt(date[1], 10),
            d = parseInt(date[2], 10),
            h = parseInt(time[0], 10),
            i = parseInt(time[1], 10);
        return new Date(y, m , d, h, i);
    }

    $.validator.addMethod("dateGreaterThan",

        function (value, element, params) {
            var theDate = parseDMYHI(value);
            var paramDate = parseDMYHI($(params).val());
            if ($(params).val() === "") return true;

            if (!/Invalid|NaN/.test(theDate)) {
                return theDate >= paramDate;
            }
            return isNaN(value) && isNaN($(params).val()) || (Number(value) >= Number($(params).val()));
        }, Translator.trans('Must be greater than OR equal Start.'));

    $.validator.addMethod("dateLessThan",

        function (value, element, params) {
            var theDate = parseDMYHI(value);
            var paramDate = parseDMYHI($(params).val());
            if ($(params).val() === "") return true;

            if (!/Invalid|NaN/.test(theDate)) {
                return theDate <= paramDate;
            }

            return isNaN(value) && isNaN($(params).val()) || (Number(value) <= Number($(params).val()));
        }, Translator.trans('Must be less than OR equal End.'));



    $("#meetup-form-new").validate(
        {
            rules: {
                'meetup[startAt]': {dateLessThan: '#meetup_endAt'},
                'meetup[endtAt]': {dateGreaterThan: '#meetup_startAt'},
            },
        }
    );

    $("#hosting-request").validate(
        {
            rules: {
                'hosting_request[startDate]': {dateLessThan: '#hosting_request_endDate'},
                'hosting_request[endDate]': {dateGreaterThan: '#hosting_request_startDate'},
            },
        }
    );
});








