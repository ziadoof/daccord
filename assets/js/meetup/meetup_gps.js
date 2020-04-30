import Translator from "bazinga-translator";

$("#btn-meetup-gps").click(function(e) {
            e.preventDefault();
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }else{
                alert(Translator.trans('Geolocation is not supported by this browser.'));
            }

        });

        function showPosition(position){
            let lat= position.coords.latitude;
            let lng= position.coords.longitude;

            $('#meetup_gps_lat').val( lat);
            $('#meetup_gps_lng').val( lng);
            document.getElementById("meetup-gps").submit();
        }