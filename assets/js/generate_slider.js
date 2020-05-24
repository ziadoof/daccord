function generateSearchOfferSlide() {
    if ($("#manufacturingYear-slider").length>0){
        let manufacturingYear_value = document.getElementById('manufacturingYear-slider').value;
        let value = manufacturingYear_value.split(",");

        $('#offer_search_minManufacturingYear option:selected').removeAttr('selected');
        $('#offer_search_maxManufacturingYear option:selected').removeAttr('selected');
        $("#offer_search_minManufacturingYear option[value=" + parseInt(value[0]) +"]").attr("selected","selected");
        $("#offer_search_maxManufacturingYear option[value=" + parseInt(value[1]) +"]").attr("selected","selected");
    }
    if ($("#kilometrage-slider").length>0) {
        let kilometrage_value = document.getElementById('kilometrage-slider').value;
        let value = kilometrage_value.split(",");
        $('#offer_search_minKilometer option:selected').removeAttr('selected');
        $('#offer_search_maxKilometer option:selected').removeAttr('selected');
        if(parseInt(value[1])===300000){
            if(parseInt(value[0])===0){
                $("#offer_search_minKilometer")[0].selectedIndex = -1;
                $("#offer_search_maxKilometer")[0].selectedIndex = -1;
            }
            else {
                $("#offer_search_minKilometer option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
                $("#offer_search_maxKilometer")[0].selectedIndex = -1;
            }
        }
        else{
            $("#offer_search_minKilometer option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
            $("#offer_search_maxKilometer option[value=" + parseInt(value[1]) + "]").attr("selected", "selected");
        }
    }
    if ($("#changeGear-slider").length>0) {
        let changeGear_value = document.getElementById('changeGear-slider').value;
        let valueArray= [null,'Automatic', 'Manual'];
        let value = valueArray[changeGear_value];
        $('#offer_search_changeGear option:selected').removeAttr('selected');
        $("#offer_search_changeGear option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#numberOfPassengers-slider").length>0) {
        let numberOfPassengers_value = document.getElementById('numberOfPassengers-slider').value;
        $('#offer_search_numberOfPassengers option:selected').removeAttr('selected');
        if(numberOfPassengers_value >0){
            $("#offer_search_numberOfPassengers option[value=" + parseInt(numberOfPassengers_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfPassengers")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfDoors-slider").length>0) {
        let numberOfDoors_value = document.getElementById('numberOfDoors-slider').value;
        $('#offer_search_numberOfDoors option:selected').removeAttr('selected');
        if(numberOfDoors_value >0){
            $("#offer_search_numberOfDoors option[value=" + parseInt(numberOfDoors_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfDoors")[0].selectedIndex = -1;
        }
    }
    if ($("#capacityMinMax-slider").length>0) {
        let capacity_value = document.getElementById('capacityMinMax-slider').value;
        let value = capacity_value.split(",");
        $('#offer_search_minCapacity option:selected').removeAttr('selected');
        $('#offer_search_maxCapacity option:selected').removeAttr('selected');
        $("#offer_search_minCapacity option[value=" + parseInt(value[0]) +"]").attr("selected", "selected");
        $("#offer_search_maxCapacity option[value=" + parseInt(value[1]) +"]").attr("selected", "selected");
    }
    if ($("#workHours-slider").length>0) {
        let workHours_value = document.getElementById('workHours-slider').value;
        let valueArray= [null,'Full', 'Partial'];
        let value = valueArray[workHours_value];
        $('#offer_search_workHours option:selected').removeAttr('selected');
        $("#offer_search_workHours option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#dvdCd-slider").length>0) {
        let dvdCd_value = document.getElementById('dvdCd-slider').value;
        let valueArray= [null,'DVD', 'CD'];
        let value = valueArray[dvdCd_value];
        $('#offer_search_dvdCd option:selected').removeAttr('selected');
        $("#offer_search_dvdCd option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#ram-slider").length>0) {
        let ram_value = document.getElementById('ram-slider').value;
        $('#offer_search_ram option:selected').removeAttr('selected');
        if(ram_value >0){
            $("#offer_search_ram option[value=" + parseInt(ram_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_ram")[0].selectedIndex = -1;
        }
    }
    if ($("#wifi-slider").length>0) {
        let wifi_value = document.getElementById('wifi-slider').value;
        $('#offer_search_wifi')[0].checked = wifi_value === '1';
    }
    if ($("#accessories-slider").length>0) {
        let value = document.getElementById('accessories-slider').value;
        $('#offer_search_accessories')[0].checked = value === '1';
    }
    if ($("#hdmi-slider").length>0) {
        let value = document.getElementById('hdmi-slider').value;
        $('#offer_search_hdmi')[0].checked = value === '1';
    }
    if ($("#cdRoom-slider").length>0) {
        let value = document.getElementById('cdRoom-slider').value;
        $('#offer_search_cdRoom')[0].checked = value === '1';
    }
    if ($("#usb-slider").length>0) {
        let value = document.getElementById('usb-slider').value;
        $('#offer_search_usb')[0].checked = value === '1';
    }
    if ($("#covered-slider").length>0) {
        let value = document.getElementById('covered-slider').value;
        $('#offer_search_covered')[0].checked = value === '1';
    }
    if ($("#electricHead-slider").length>0) {
        let value = document.getElementById('electricHead-slider').value;
        $('#offer_search_electricHead')[0].checked = value === '1';
    }
    if ($("#threeInOne-slider").length>0) {
        let value = document.getElementById('threeInOne-slider').value;
        $('#offer_search_threeInOne')[0].checked = value === '1';
    }
    if ($("#Oven-slider").length>0) {
        let value = document.getElementById('Oven-slider').value;
        $('#offer_search_withOven')[0].checked = value === '1';
    }
    if ($("#Elevator-slider").length>0) {
        let value = document.getElementById('Elevator-slider').value;
        $('#offer_search_withElevator')[0].checked = value === '1';
    }
    if ($("#Freezer-slider").length>0) {
        let value = document.getElementById('Freezer-slider').value;
        $('#offer_search_withFreezer')[0].checked = value === '1';
    }
    if ($("#Furniture-slider").length>0) {
        let value = document.getElementById('Furniture-slider').value;
        $('#offer_search_withFurniture')[0].checked = value === '1';
    }
    if ($("#Garden-slider").length>0) {
        let value = document.getElementById('Garden-slider').value;
        $('#offer_search_withGarden')[0].checked = value === '1';
    }
    if ($("#Verandah-slider").length>0) {
        let value = document.getElementById('Verandah-slider').value;
        $('#offer_search_withVerandah')[0].checked = value === '1';
    }
    if ($("#numberOfHead-slider").length>0) {
        let numberOfHead_value = document.getElementById('numberOfHead-slider').value;
        $('#offer_search_numberOfHead option:selected').removeAttr('selected');
        if(numberOfHead_value >0){
            $("#offer_search_numberOfHead option[value=" + parseInt(numberOfHead_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfHead")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfPersson-slider").length>0) {
        let numberOfPersson_value = document.getElementById('numberOfPersson-slider').value;
        $('#offer_search_numberOfPersson option:selected').removeAttr('selected');
        if(numberOfPersson_value >0){
            $("#offer_search_numberOfPersson option[value=" + parseInt(numberOfPersson_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfPersson")[0].selectedIndex = -1;
        }
    }
    if ($("#number-slider").length>0) {
        let number_value = document.getElementById('number-slider').value;
        $('#offer_search_number option:selected').removeAttr('selected');
        if(number_value >0){
            $("#offer_search_number option[value=" + parseInt(number_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_number")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfRooms-slider").length>0) {
        let numberOfRooms_value = document.getElementById('numberOfRooms-slider').value;
        $('#offer_search_numberOfRooms option:selected').removeAttr('selected');
        if(numberOfRooms_value >0){
            $("#offer_search_numberOfRooms option[value=" + parseInt(numberOfRooms_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfRooms")[0].selectedIndex = -1;
        }
    }
    if ($("#AreaMinMax-slider").length>0) {
        let area_value = document.getElementById('AreaMinMax-slider').value;
        let value = area_value.split(",");
        let idOptions = document.getElementById('offer_search_maxArea').options;
        let last = idOptions.length;
        let max = idOptions[last-1].value;
        $('#offer_search_minArea option:selected').removeAttr('selected');
        $('#offer_search_maxArea option:selected').removeAttr('selected');
        if(parseInt(value[1])=== parseInt(max)){
            if(parseInt(value[0])===0){
                $("#offer_search_minArea")[0].selectedIndex = -1;
                $("#offer_search_maxArea")[0].selectedIndex = -1;
            }
            else {
                $("#offer_search_minArea option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
                $("#offer_search_maxArea")[0].selectedIndex = -1;
            }
        }
        else{
            $("#offer_search_minArea option[value=" + parseInt(value[0]) + "]").attr("selected", "selected");
            $("#offer_search_maxArea option[value=" + parseInt(value[1]) + "]").attr("selected", "selected");
        }
    }
    if ($("#classEnergie-slider").length>0) {
        let classEnergie_value = document.getElementById('classEnergie-slider').value;
        $('#offer_search_classEnergie option:selected').removeAttr('selected');
        if(classEnergie_value>0){
            $("#offer_search_classEnergie option[value=" + classEnergie_value +"]").attr("selected", "selected");
        }
    }
    if ($("#classGes-slider").length>0) {
        let classGes_value = document.getElementById('classGes-slider').value;
        $('#offer_search_ges option:selected').removeAttr('selected');
        if(classGes_value>0){
            $("#offer_search_ges option[value=" + classGes_value +"]").attr("selected", "selected");
        }
    }
    if ($("#numberOfDrawer-slider").length>0) {
        let numberOfDrawer_value = document.getElementById('numberOfDrawer-slider').value;
        $('#offer_search_numberOfDrawer option:selected').removeAttr('selected');

        if(numberOfDrawer_value >0){
            $("#offer_search_numberOfDrawer option[value=" + parseInt(numberOfDrawer_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfDrawer")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfStaging-slider").length>0) {
        let numberOfStaging_value = document.getElementById('numberOfStaging-slider').value;
        $('#offer_search_numberOfStaging option:selected').removeAttr('selected');

        if(numberOfStaging_value >0){
            $("#offer_search_numberOfStaging option[value=" + parseInt(numberOfStaging_value) +"]").attr("selected", "selected");
        }
        else{
            $("#offer_search_numberOfStaging")[0].selectedIndex = -1;
        }
    }


}

function generateSearchDemandSlide() {
    if ($("#manufacturingYear-slider-demand").length>0){
        let manufacturingYear_value = document.getElementById('manufacturingYear-slider-demand').value;

        $('#demand_search_manufacturingYear option:selected').removeAttr('selected');
        $("#demand_search_manufacturingYear option[value=" + parseInt(manufacturingYear_value) +"]").attr("selected","selected");
    }
    if ($("#changeGear-slider-demand").length>0) {
        let changeGear_value = document.getElementById('changeGear-slider-demand').value;
        let valueArray= [null,'Automatic', 'Manual'];
        let value = valueArray[changeGear_value];
        $('#demand_search_changeGear option:selected').removeAttr('selected');
        $("#demand_search_changeGear option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#numberOfPassengers-slider-demand").length>0) {
        let numberOfPassengers_value = document.getElementById('numberOfPassengers-slider-demand').value;
        $('#demand_search_numberOfPassengers option:selected').removeAttr('selected');
        if(numberOfPassengers_value >0){
            $("#demand_search_numberOfPassengers option[value=" + parseInt(numberOfPassengers_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfPassengers")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfDoors-slider-demand").length>0) {
        let numberOfDoors_value = document.getElementById('numberOfDoors-slider-demand').value;
        $('#demand_search_numberOfDoors option:selected').removeAttr('selected');
        if(numberOfDoors_value >0){
            $("#demand_search_numberOfDoors option[value=" + parseInt(numberOfDoors_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfDoors")[0].selectedIndex = -1;
        }
    }
    if ($("#workHours-slider-demand").length>0) {
        let workHours_value = document.getElementById('workHours-slider-demand').value;
        let valueArray= [null,'Full', 'Partial'];
        let value = valueArray[workHours_value];
        $('#demand_search_workHours option:selected').removeAttr('selected');
        $("#demand_search_workHours option[value=" + value +"]").attr("selected", "selected");
    }

    if ($("#dvdCd-slider-demand").length>0) {
        let dvdCd_value = document.getElementById('dvdCd-slider-demand').value;
        let valueArray= [null,'DVD', 'CD'];
        let value = valueArray[dvdCd_value];
        $('#demand_search_dvdCd option:selected').removeAttr('selected');
        $("#demand_search_dvdCd option[value=" + value +"]").attr("selected", "selected");
    }
    if ($("#wifi-slider-demand").length>0) {
        let wifi_value = document.getElementById('wifi-slider-demand').value;
        $('#demand_search_wifi')[0].checked = wifi_value === '1';
    }
    if ($("#accessories-slider-demand").length>0) {
        let value = document.getElementById('accessories-slider-demand').value;
        $('#demand_search_accessories')[0].checked = value === '1';
    }
    if ($("#hdmi-slider-demand").length>0) {
        let value = document.getElementById('hdmi-slider-demand').value;
        $('#demand_search_hdmi')[0].checked = value === '1';
    }
    if ($("#cdRoom-slider-demand").length>0) {
        let value = document.getElementById('cdRoom-slider-demand').value;
        $('#demand_search_cdRoom')[0].checked = value === '1';
    }
    if ($("#usb-slider-demand").length>0) {
        let value = document.getElementById('usb-slider-demand').value;
        $('#demand_search_usb')[0].checked = value === '1';
    }
    if ($("#covered-slider-demand").length>0) {
        let value = document.getElementById('covered-slider-demand').value;
        $('#demand_search_covered')[0].checked = value === '1';
    }
    if ($("#electricHead-slider-demand").length>0) {
        let value = document.getElementById('electricHead-slider-demand').value;
        $('#demand_search_electricHead')[0].checked = value === '1';
    }
    if ($("#threeInOne-slider-demand").length>0) {
        let value = document.getElementById('threeInOne-slider-demand').value;
        $('#demand_search_threeInOne')[0].checked = value === '1';
    }
    if ($("#Oven-slider-demand").length>0) {
        let value = document.getElementById('Oven-slider-demand').value;
        $('#demand_search_withOven')[0].checked = value === '1';
    }
    if ($("#Elevator-slider-demand").length>0) {
        let value = document.getElementById('Elevator-slider-demand').value;
        $('#demand_search_withElevator')[0].checked = value === '1';
    }
    if ($("#Freezer-slider-demand").length>0) {
        let value = document.getElementById('Freezer-slider-demand').value;
        $('#demand_search_withFreezer')[0].checked = value === '1';
    }
    if ($("#Furniture-slider-demand").length>0) {
        let value = document.getElementById('Furniture-slider-demand').value;
        $('#demand_search_withFurniture')[0].checked = value === '1';
    }
    if ($("#Garden-slider-demand").length>0) {
        let value = document.getElementById('Garden-slider-demand').value;
        $('#demand_search_withGarden')[0].checked = value === '1';
    }
    if ($("#Verandah-slider-demand").length>0) {
        let value = document.getElementById('Verandah-slider-demand').value;
        $('#demand_search_withVerandah')[0].checked = value === '1';
    }
    if ($("#ram-slider-demand").length>0) {
        let ram_value = document.getElementById('ram-slider-demand').value;
        $('#demand_search_ram option:selected').removeAttr('selected');
        if(ram_value >0){
            $("#demand_search_ram option[value=" + parseInt(ram_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_ram")[0].selectedIndex = -1;
        }
    }
    if ($("#capacity-slider-demand").length>0) {
        let capacity_value = document.getElementById('capacity-slider-demand').value;
        $('#demand_search_capacity option:selected').removeAttr('selected');
        if(capacity_value >0){
            $("#demand_search_capacity option[value=" + parseInt(capacity_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_capacity")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfHead-slider-demand").length>0) {
        let numberOfHead_value = document.getElementById('numberOfHead-slider-demand').value;
        $('#demand_search_numberOfHead option:selected').removeAttr('selected');
        if(numberOfHead_value >0){
            $("#demand_search_numberOfHead option[value=" + parseInt(numberOfHead_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfHead")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfPersson-slider-demand").length>0) {
        let numberOfPersson_value = document.getElementById('numberOfPersson-slider-demand').value;
        $('#demand_search_numberOfPersson option:selected').removeAttr('selected');
        if(numberOfPersson_value >0){
            $("#demand_search_numberOfPersson option[value=" + parseInt(numberOfPersson_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfPersson")[0].selectedIndex = -1;
        }
    }
    if ($("#number-slider-demand").length>0) {
        let number_value = document.getElementById('number-slider-demand').value;
        $('#demand_search_number option:selected').removeAttr('selected');
        if(number_value >0){
            $("#demand_search_number option[value=" + parseInt(number_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_number")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfRooms-slider-demand").length>0) {
        let numberOfRooms_value = document.getElementById('numberOfRooms-slider-demand').value;
        $('#demand_search_numberOfRooms option:selected').removeAttr('selected');
        if(numberOfRooms_value >0){
            $("#demand_search_numberOfRooms option[value=" + parseInt(numberOfRooms_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfRooms")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfDrawer-slider-demand").length>0) {
        let numberOfDrawer_value = document.getElementById('numberOfDrawer-slider-demand').value;
        $('#demand_search_numberOfDrawer option:selected').removeAttr('selected');

        if(numberOfDrawer_value >0){
            $("#demand_search_numberOfDrawer option[value=" + parseInt(numberOfDrawer_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfDrawer")[0].selectedIndex = -1;
        }
    }
    if ($("#numberOfStaging-slider-demand").length>0) {
        let numberOfStaging_value = document.getElementById('numberOfStaging-slider-demand').value;
        $('#demand_search_numberOfStaging option:selected').removeAttr('selected');

        if(numberOfStaging_value >0){
            $("#demand_search_numberOfStaging option[value=" + parseInt(numberOfStaging_value) +"]").attr("selected", "selected");
        }
        else{
            $("#demand_search_numberOfStaging")[0].selectedIndex = -1;
        }
    }
}
function generateHostingSlide() {
    let numberOfPerson_value = document.getElementById('numberOfPerson-slider-hosting').value;
    $('#hosting_search_numberOfPersons option:selected').removeAttr('selected');

    if(numberOfPerson_value >0){
        $("#hosting_search_numberOfPersons option[value=" + parseInt(numberOfPerson_value) +"]").attr("selected", "selected");
    }
    else{
        $("#hosting_search_numberOfPersons")[0].selectedIndex = 1;
    }

    let numberOfDays_value = document.getElementById('numberOfDays-slider-hosting').value;
    $('#hosting_search_numberOfDays option:selected').removeAttr('selected');

    if(numberOfDays_value >0){
        $("#hosting_search_numberOfDays option[value=" + parseInt(numberOfDays_value) +"]").attr("selected", "selected");
    }
    else{
        $("#hosting_search_numberOfDays")[0].selectedIndex = 1;
    }

}

export {generateSearchOfferSlide,generateSearchDemandSlide,generateHostingSlide};