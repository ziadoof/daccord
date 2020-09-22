import ymaps from "ymaps";
import Translator from "bazinga-translator";

let myMap;
let points={};
let fixedVia = [];
ymaps
    .load('https://api-maps.yandex.ru/2.1/?apikey=e14971ea-41eb-469b-b5ed-ffc8fbd66723&lang=en_US')
    .then(maps => {

        maps.ready(init);
        let activeVoyageForm = $('#voyage-form-new2').length > 0;
        function init () {
            if(activeVoyageForm){
                // Map parameters can be set in the constructor.
                myMap = new maps.Map('map',
                    // Map parameters.
                    {
                        // Geographical coordinates of the center of the displayed map.
                        center: [47.050661,2.342608],
                        // Scale.
                        zoom: 5,
                        controls: []
                    }
                );
            }
        }

        let NofStation = -1;
        if(activeVoyageForm){
            $('.carpooling-form').collection({
                add:'<a href="#" class="collection-add btn btn-info mb-4"><i class="fas fa-plus"></i>' +Translator.trans('Add station')+ '</a>',
                up:false,
                down:false,
                max: 5,
                min:0,
                after_add: function(collection, element) {
                    NofStation ++;
                    let city_id = '#voyage_first_stations_' + NofStation + '_city';
                    $(city_id).attr('data-id',NofStation);
                    $(completeAuto(city_id,'point',NofStation));

                },
                before_remove: function(collection, element){
                    let pointKey = parseInt(element[0].childNodes[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].getAttribute('data-id'), 10);
                    for(let g=0;g<fixedVia.length;g++){

                        if(fixedVia[g][3]=== pointKey){
                            fixedVia.splice(g, 1);
                        }
                    }
                    createRoute(points);
                },
                add_at_the_end: true,
            });
        }


        function createRoute(points){

            let start;
            let end;

            if (typeof points !== 'undefined') {
                if(typeof points['start']!=='undefined'){
                    if(points['start']!==''){
                        start = [points['start'][0],points['start'][1]];
                    }
                    else  start = "";
                }
                else  start = "";
                if (typeof points['end']!=='undefined'){
                    if(points['end']!==''){
                        end = [points['end'][0],points['end'][1]];
                    }
                    else  end = "";
                }
                else  end = "";
            }
            else {
                start = "";
                end = "";
            }

            var multiRoute = new maps.multiRouter.MultiRoute({
                // The description of the reference points on the multi-stop route.
                referencePoints: [start,end],
                // Routing options.
                params: {
                    // Limit on the maximum number of routes returned by the router.
                    results: 1,
                }
            }, {
                // Automatically set the map boundaries so the entire route is visible.
                boundsAutoApply: true,
            });

            multiRoute.model.events.add('requestsuccess', function() {
                // Get a reference to the active route.
                var activeRoute = multiRoute.getActiveRoute();
                // Output route information.
                const viewContainer = document.getElementById('viewContainer');
                if(activeRoute){
                    var distance = Math.floor(activeRoute.properties.get("distance").value / 1000);
                    viewContainer.innerHTML = "<span>Distance: " + distance+" Km" +"</span> <br> <span>"+
                        "Travel time: " + activeRoute.properties.get("duration").text +"</span>";
                    let mainDistance = document.getElementById('voyage_first_distance');
                    let mainDuration = document.getElementById('voyage_first_duration');
                    mainDistance.value=distance;
                    mainDuration.value=activeRoute.properties.get("duration").value;

                    if (activeRoute.properties.get("blocked")) {
                        viewContainer.innerHTML = "<span> The route has sections with closed roads. </span>";
                    }
                }
            });


            for(const [key, value] of Object.entries(points)){
                if(value[2]==='point'){
                    let station = parseInt(key.substr(5));
                    // this status run when user change city in same field station, remove last station from fixedVia in same index
                    for(const [fixKey, fixValue] of Object.entries(fixedVia)){
                        if(fixValue[3]=== station){
                            fixedVia.splice(parseInt(fixKey),1);
                        }
                    }
                    value.push(station);
                    fixedVia.push(value);
                    delete points[key];
                }
            }

            fixedVia.sort(function(a, b){return a[3] - b[3]});
            for(let z=0;z<fixedVia.length;z++){
                let city = [fixedVia[z][0],fixedVia[z][1]];
                let referencePoints = multiRoute.model.getReferencePoints();
                let index = referencePoints.length -1;
                referencePoints.splice(index, 0, city);
                multiRoute.model.setReferencePoints(referencePoints);

                const time_id = 'voyage_first_stations_' + fixedVia[z][3] + '_duration';
                const distance_id = 'voyage_first_stations_' + fixedVia[z][3] + '_distance';
                let time= document.getElementById(time_id);
                let distance= document.getElementById(distance_id);

                let newMultiRoute = new maps.multiRouter.MultiRoute({
                    // The description of the reference points on the multi-stop route.
                    referencePoints: [],
                    // Routing options.
                    params: {
                        // Limit on the maximum number of routes returned by the router.
                        results: 1,
                    }
                }, {
                    // Automatically set the map boundaries so the entire route is visible.
                    boundsAutoApply: true,
                });
                if(z ===0){
                    newMultiRoute.model.setReferencePoints([start,city]);
                }
                else {
                    newMultiRoute.model.setReferencePoints([[fixedVia[z-1][0],fixedVia[z-1][1]],city]);
                }
                newMultiRoute.model.events.add('requestsuccess', function() {
                    // Get a reference to the active route.
                    let localActiveRoute = newMultiRoute.getActiveRoute();
                    // Output route information.
                    if(localActiveRoute){
                        if($('#'+distance_id).length===0 || $('#'+time_id) === 0){
                            alert(Translator.trans('There is a problem'));
                        }
                        if (localActiveRoute.properties.get("blocked")) {
                            alert(Translator.trans('The route has sections with closed roads.'));
                        }
                        else {
                            distance.value = Math.floor(localActiveRoute.properties.get("distance").value / 1000);
                            time.value = Math.floor(localActiveRoute.properties.get("duration").value);
                        }

                    }
                });
            }
            myMap.destroy();

            myMap = new maps.Map('map',
                // Map parameters.
                {
                    // Geographical coordinates of the center of the displayed map.
                    center: [47.050661,2.342608],
                    // Scale.
                    zoom: 5,
                    controls: []
                }
            );

            myMap.geoObjects.add(multiRoute);
        }

        $(document).ready(function() {
            $(completeAuto('#voyage_first_mainDeparture','departure',0));
            $(completeAuto('#voyage_first_mainArrival','arrival',0));
        });

        function completeAuto(id,type,i) {
            let makeSelect = false;

            let $this = $(id), $fakeInput = $this.clone();
            $fakeInput.attr('id', 'fake_' + $fakeInput.attr('id'));
            $fakeInput.attr('name', 'fake_' + $fakeInput.attr('name'));
            $this.hide().after($fakeInput);
            $fakeInput.autocomplete({
                source: $('#url-one-list').attr('href'),
                autoFocus: true,
                minLength:2,
                theme: 'bootstrap',
                formatNoMatches: Translator.trans('No city found.'),
                formatSearching: Translator.trans('Searching city...'),
                formatInputTooShort: Translator.trans('Insert at least 2 character'),
                close: function(e, ui) {
                    if (!makeSelect) {
                        $this.val(false);
                    }
                },
                response:function( event, ui ){
                    if (!makeSelect) {
                        $this.val(false);
                    }
                },
                focus: function(event, ui) {
                    event.preventDefault();
                    $this.val(ui.item.label);
                },
                select: function (event, ui) {
                    event.preventDefault();
                    makeSelect = true;
                    $this.val(ui.item.value);
                    $(this).val(ui.item.label);

                    let city_id = ui.item.value;
                    let url = Routing.generate('city_pine');
                    $.ajax({
                        method: "post",
                        dataType: "json",
                        url: url,
                        async: true,
                        data:{'id':city_id,'type':type},
                    }).done( function(response) {
                        if(response[0]!==0){

                            if(response[2]==='departure'){
                                points['start']=response;
                                createRoute(points);
                            }
                            if(response[2]==='arrival'){
                                points['end']=response;
                                createRoute(points);
                            }
                            if(response[2]==='point'){
                                points['point'+i] = response;
                                createRoute(points);
                            }
                        }

                    }).fail(function(jxh,textmsg,errorThrown){
                        alert(Translator.trans('Something went wrong during processing search for city!'));
                    });

                },

            });

        }


    })
    .catch(error => console.log('Failed to load Yandex Maps', error));

//obliget user to no enter data in input date
$("#voyage_first_date").keydown(function (event) {
    event.preventDefault();
});

document.addEventListener("DOMContentLoaded", function(){

    tail.DateTime("#voyage_first_date",{
        locale: "fr",
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

    tail.DateTime("#voyage_first_time",{
        locale: "fr",
        weekStart: 1,
        startOpen: false,
        stayOpen: false,
        dateFormat: false,
        timeFormat: "HH:ii",
        zeroSeconds: false,
        today: true,
        closeButton:false,
        timeSeconds: null,
        dateStart:  new Date()

    });
});

