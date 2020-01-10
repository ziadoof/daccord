import tail from './tail.datetime-full';

//------------------------------------//
document.addEventListener("DOMContentLoaded", function(){

        tail.DateTime("#meetup_startAt",{
            locale: "fr",
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
            locale: "fr",
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

        tail.DateTime("#meetup_startAt").on('change',function () {
            tail.DateTime("#meetup_endAt").remove();

            tail.DateTime("#meetup_endAt",{
                locale: "fr",
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
        tail.DateTime("#meetup_endAt").on('change',function () {
            tail.DateTime("#meetup_startAt").remove();

            tail.DateTime("#meetup_startAt",{
                locale: "fr",
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
            }, 'Must be greater than OR equal Start.');

        $.validator.addMethod("dateLessThan",

            function (value, element, params) {
                var theDate = parseDMYHI(value);
                var paramDate = parseDMYHI($(params).val());
                if ($(params).val() === "") return true;

                if (!/Invalid|NaN/.test(theDate)) {
                    return theDate <= paramDate;
                }

                return isNaN(value) && isNaN($(params).val()) || (Number(value) <= Number($(params).val()));
            }, 'Must be less than OR equal End.');



        $("#meetup-form-new").validate(
            {
                rules: {
                    'meetup[startAt]': {dateLessThan: '#meetup_endAt'},
                    'meetup[endtAt]': {dateGreaterThan: '#meetup_startAt'},

                },
            }
        );
    });