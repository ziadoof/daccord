import ymaps from "ymaps";

var NOCollection = -1;
let activeSpeform = $('#category_specification_specifications').length > 0;
if(activeSpeform){
    $('.specification-form').collection({
        add:'<a href="#" class="collection-add btn btn-info mb-4"><i class="fas fa-plus"></i> Add specification </a>',
        up:false,
        down:false,
        max: 14,
        min:0,

        after_add: function(collection, element) {
            NOCollection ++;

            let nameId = '#category_specification_specifications_'+NOCollection+'_name';
            let typeId = '#category_specification_specifications_'+NOCollection+'_type';
            let typeOfChoiceId = '#category_specification_specifications_'+NOCollection+'_typeOfChoice';

            $(document).on('change', nameId, function () {
                let $field = $(this);
                let $nameField = $(nameId);
                let $form = $field.closest('form');

                let target = '#' + $field.attr('id').replace('name', 'type');
                // Les données à envoyer en Ajax
                let data = {};
                data[$nameField.attr('name')] = $nameField.val();
                data[$field.attr('name')] = $field.val();
                // On soumet les données

                $.post($form.attr('action'), data).then(function (data) {
                    // On récupère le nouveau <select>
                    let $input = $(data).find(target);
                    // On remplace notre <select> actuel
                    $(target).replaceWith($input);
                });
            });

            $(document).on('change', typeId, function () {
                let $field = $(this);
                let $typeField = $(nameId);
                let $form = $field.closest('form');
                let target = '#' + $field.attr('id').replace('type', 'typeOfChoice');
                // Les données à envoyer en Ajax
                let data = {};
                data[$typeField.attr('name')] = $typeField.val();
                data[$field.attr('name')] = $field.val();
                // On soumet les données

                $.post($form.attr('action'), data).then(function (data) {
                    // On récupère le nouveau <select>
                    let $input = $(data).find(target);
                    // On remplace notre <select> actuel
                    $(target).replaceWith($input);
                });
            });

            $(document).on('change', typeOfChoiceId, function () {
                let $optionsTypeAdmin = $(typeOfChoiceId);

                let $form = $(this).closest('form');
                let data = {};
                data[$optionsTypeAdmin.attr('name')] = $optionsTypeAdmin.val();
                // Submit data via AJAX to the form's action path.
                $.ajax({
                    url : $form.attr('action'),
                    type: $form.attr('method'),
                    data : data,
                    success: function(html) {
                        var $dynamicForm = $(html).find('#dynamic-options');
                        $dynamicForm.children(".form-group").each(function (index, item){
                            var $item = $(item);
                            $item.removeClass('has-error');
                            $item.find(".help-block").remove();
                        });
                        $(element[0].querySelector('#dynamic-options')).replaceWith($dynamicForm);
                    }

                });
            });

        },
        add_at_the_end: true,
    });
}
$(document).ready(function() {
    let makeSelect = false;

    let $this = $('#user_city'), $fakeInput = $this.clone();
    $fakeInput.attr('id', 'fake_' + $fakeInput.attr('id'));
    $fakeInput.attr('name', 'fake_' + $fakeInput.attr('name'));
    $this.hide().after($fakeInput);
    let input = document.getElementById('fake_user_city');
    if(input !== null){
        let div = input.parentNode;
        $(div).addClass('ui-front');
    }

    $fakeInput.autocomplete({
        source: $('#url-list').attr('href'),
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
        },

    });
});


// user map
$(document).ready(function (){
    $('#users_map').hide();
})
$(document).on('click', "#toUsersMap",function () {
    var url = Routing.generate('users_map');
    $.ajax({
        url: url,
        async: true,
        type: "POST",
        success: function (response) {
            if (response['location'].length >0){
                $('#users_table').hide();
                $('#users_map').show();
                // test code
                let location = response['location'];
                let data = response['data'];

        ymaps
            .load('https://api-maps.yandex.ru/2.1/?apikey=e14971ea-41eb-469b-b5ed-ffc8fbd66723&lang=en_US')
            .then(maps => {
                maps.ready(init);
                function init() {

                    var myMap = new maps.Map('users_map', {
                            center: [47.050661, 1.342608],
                            // Scale.
                            zoom: 8,
                            behaviors: ['default', 'scrollZoom']
                        }, {
                            searchControlProvider: 'yandex#search'
                        }),
                        /**
                         * Creating a clusterer by calling a constructor function.
                         * A list of all options is available in the documentation.
                         * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
                         */
                        clusterer = new maps.Clusterer({
                            /**
                             * Only cluster styles can be specified via the clusterer;
                             * for placemark styles, each placemark must be set separately.
                             * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
                             */
                            preset: 'islands#invertedBlueClusterIcons',
                            /**
                             * Setting to "true" if we want to cluster only points with the same coordinates.
                             */
                            groupByCoordinates: false,
                            /**
                             * Setting cluster options in the clusterer with the "cluster" prefix.
                             * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
                             */
                            clusterDisableClickZoom: true,
                            clusterHideIconOnBalloonOpen: false,
                            geoObjectHideIconOnBalloonOpen: false
                        }),
                        /**
                         * The function returns an object containing the placemark data.
                         * The clusterCaption data field will appear in the list of geo objects in the cluster balloon.
                         * The balloonContentBody field is the data source for the balloon content.
                         * Both fields support HTML markup.
                         * For a list of data fields that are used by the standard content layouts for
                         * geo objects' placemark icons and balloons, see the documentation.
                         * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                         */
                        getPointData = function (index) {
                            let name = data[index]['firstname']+' '+data[index]['lastname'];
                            let id = data[index]['id'];
                            let ville = data[index]['ville'];
                            let lastLogin = data[index]['lastLogin']?data[index]['lastLogin']['date'].substring(0,16):'Inconnu';
                            let lastActivityAt = data[index]['lastActivityAt']?data[index]['lastActivityAt'].date.substring(0,16):'Inconnu';
                            let enabled = data[index]['enabled']?'Oui':'Non';
                            let image = data[index]['image']?'/assets/images/profile/'+data[index]['image']:'/assets/images/profile/user-avatar.png';
                            return {
                                balloonContentHeader: '<font size=3><b>'+name+'</b></font>',
                                balloonContentBody: '<a target="_blank" href="https://dispodeal.fr/user/'+id+'"><img src="'+image+'" alt=""></a><p class="mb-0">Ville: '+ville+'</p><p class="mb-0">Active:'+enabled+'</p><p class="mb-0">Last login: '+lastLogin+'</p><p class="mb-0">Last Activity: '+lastActivityAt+'</p>',
                                clusterCaption: '<small>'+name+'</small>'
                            };
                        },
                        /**
                         * The function returns an object containing the placemark options.
                         * All options that are supported by the geo objects can be found in the documentation.
                         * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                         */
                        getPointOptions = function () {
                            return {
                                preset: 'islands#blueIcon'
                            };
                        },
                        points = location,
                        geoObjects = [];

                    /**
                     * Data is passed to the placemark constructor as the second parameter, and options are third.
                     * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
                     */
                    for(var i = 0, len = points.length; i < len; i++) {
                        geoObjects[i] = new maps.Placemark(points[i], getPointData(i), getPointOptions());
                    }

                    /**
                     * You can change clusterer options after creation.
                     */
                    clusterer.options.set({
                        gridSize: 80,
                        clusterDisableClickZoom: true
                    });

                    /**
                     * You can add a JavaScript array of placemarks (not a geo collection) or a single placemark to the clusterer.
                     * @see https://api.yandex.com/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
                     */
                    clusterer.add(geoObjects);
                    myMap.geoObjects.add(clusterer);

                    /**
                     * Positioning the map so that all objects become visible.
                     */

                    myMap.setBounds(clusterer.getBounds(), {
                        checkZoomRange: true
                    });
                }
            })
            .catch(error => console.log('Failed to load Yandex Maps', error));
                // end test cod
            }
        }
    });
});

$(document).ready(function (){
    let data = {};
    var url = Routing.generate('add_visit');
    $.ajax({
        url : url,
        type: "POST",
        async: true,
        data : data,
        success: function(response) {
        }
    });
});
