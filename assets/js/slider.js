
// add range slider for specification//
import Translator from "bazinga-translator";

const Slider = require("bootstrap-slider");

function addOfferSearchSlider() {

    if ($("#manufacturingYear-slider").is(":visible")){
        let idOptions = document.getElementById('offer_search_maxManufacturingYear').options;
        let firstYear = idOptions.length-1;
        let options =[parseInt(idOptions[firstYear].value)-1];
        for (let i=idOptions.length-1; i>0; i--) {
            options.push(parseInt(idOptions[i].value));
        }
        let last = options.length;
        let value = [options[0], options[last-1]];
        let manufacturingYear = new Slider("#manufacturingYear-slider", {
            min: options[0], max: options[last-1], value: value, focus: true
        });
    }
    if ($("#kilometrage-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxKilometer').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];
        let kilometrage = new Slider("#kilometrage-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#changeGear-slider").is(":visible")) {
        let all = Translator.trans("All");
        let auto = Translator.trans("Automatic");
        let man = Translator.trans("Manual");
        let id = document.getElementById('changeGear-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ auto+'","'+ man + '"]');
        let changeGear = new Slider('#changeGear-slider',{
        });
        $( ".change-gear" ).children().addClass("white");
    }
    if ($("#numberOfPassengers-slider").is(":visible")) {

        let numberOfPassengers = new Slider('#numberOfPassengers-slider',{
            min: 0,
            max: 48,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfDoors-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfDoors').options;
        let last = (idOptions.length)-1;
        let numberOfDoors = new Slider('#numberOfDoors-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#capacityMinMax-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxCapacity').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];

        let placeholder = $('#offer_search_minCapacity option:selected').text();
        let title = placeholder.substr(4);
        $("#minMaxCapacityOfferSearch").text(toTitleCase(title));
        let capacity = new Slider("#capacityMinMax-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#workHours-slider").is(":visible")) {
        let all = Translator.trans("All");
        let full = Translator.trans("Full");
        let partial = Translator.trans("Partial");
        let id = document.getElementById('workHours-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ full+'","'+ partial + '"]');
        let workHours = new Slider('#workHours-slider',{
        });
        $( ".workHoursOfferSearch" ).children().addClass("white");
    }
    if ($("#dvdCd-slider").is(":visible")) {
        let all = Translator.trans("All");
        let dvd = Translator.trans("DVD");
        let cd = Translator.trans("CD");
        let id = document.getElementById('dvdCd-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ dvd +'","'+ cd + '"]');
        let dvdCd = new Slider('#dvdCd-slider',{
        });
        $( ".dvdCdOfferSearch" ).children().addClass("white");
    }
    if ($("#ram-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_ram').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }

        let placeholder = $('#offer_search_ram option:selected').text();
        let title = placeholder.substr(4);
        $("#ramOfferSearch").text(toTitleCase(title));
        let ram = new Slider("#ram-slider", {
            ticks: Options,
            value:0
        });
    }
    if ($("#wifi-slider").is(":visible")) {
        let all = Translator.trans("All");
        let wifi = Translator.trans("Wifi");
        let id = document.getElementById('wifi-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ wifi + '"]');
        let slider = new Slider('#wifi-slider',{
        });
        $( ".wifiOfferSearch" ).children().addClass("white");
    }
    if ($("#accessories-slider").is(":visible")) {
        let all = Translator.trans("All");
        let accessories = Translator.trans("Accessories");
        let id = document.getElementById('accessories-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ accessories + '"]');
        let slider = new Slider('#accessories-slider',{
        });
        $( ".accessoriesOfferSearch" ).children().addClass("white");
    }
    if ($("#hdmi-slider").is(":visible")) {
        let all = Translator.trans("All");
        let hdmi = Translator.trans("Hdmi");
        let id = document.getElementById('hdmi-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ hdmi + '"]');
        let slider = new Slider('#hdmi-slider',{
        });
        $( ".hdmiOfferSearch" ).children().addClass("white");
    }
    if ($("#cdRoom-slider").is(":visible")) {
        let all = Translator.trans("All");
        let cdRoom = Translator.trans("Cd Room");
        let id = document.getElementById('cdRoom-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ cdRoom + '"]');
        let slider = new Slider('#cdRoom-slider',{
        });
        $( ".cdRoomOfferSearch" ).children().addClass("white");
    }
    if ($("#usb-slider").is(":visible")) {
        let all = Translator.trans("All");
        let usb = Translator.trans("Usb");
        let id = document.getElementById('usb-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ usb + '"]');
        let slider = new Slider('#usb-slider',{
        });
        $( ".usbOfferSearch" ).children().addClass("white");
    }
    if ($("#covered-slider").is(":visible")) {
        let all = Translator.trans("All");
        let covered = Translator.trans("Covered");
        let id = document.getElementById('covered-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ covered + '"]');
        let slider = new Slider('#covered-slider',{
        });
        $( ".coveredOfferSearch" ).children().addClass("white");
    }
    if ($("#electricHead-slider").is(":visible")) {
        let all = Translator.trans("All");
        let electricHead = Translator.trans("Electric Head");
        let id = document.getElementById('electricHead-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ electricHead + '"]');
        let slider = new Slider('#electricHead-slider',{
        });
        $( ".electricHeadOfferSearch" ).children().addClass("white");
    }
    if ($("#threeInOne-slider").is(":visible")) {
        let all = Translator.trans("All");
        let threeInOne = Translator.trans("Three In One");
        let id = document.getElementById('threeInOne-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ threeInOne + '"]');
        let slider = new Slider('#threeInOne-slider',{
        });
        $( ".threeInOneOfferSearch" ).children().addClass("white");
    }
    if ($("#Oven-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withOven = Translator.trans("With Oven");
        let id = document.getElementById('Oven-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withOven + '"]');
        let slider = new Slider('#Oven-slider',{
        });
        $( ".OvenOfferSearch" ).children().addClass("white");
    }
    if ($("#Elevator-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withElevator = Translator.trans("With Elevator");
        let id = document.getElementById('Elevator-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withElevator + '"]');
        let slider = new Slider('#Elevator-slider',{
        });
        $( ".ElevatorOfferSearch" ).children().addClass("white");
    }
    if ($("#Freezer-slider").is(":visible")) {
        let all = Translator.trans("All");
        let withFreezer = Translator.trans("With Freezer");
        let id = document.getElementById('Freezer-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withFreezer + '"]');
        let slider = new Slider('#Freezer-slider',{
        });
        $( ".FreezerOfferSearch" ).children().addClass("white");
    }
    if ($("#Furniture-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Furniture = Translator.trans("With Furniture");
        let id = document.getElementById('Furniture-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Furniture + '"]');
        let slider = new Slider('#Furniture-slider',{
        });
        $( ".FurnitureOfferSearch" ).children().addClass("white");
    }
    if ($("#Garden-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Garden = Translator.trans("With Garden");
        let id = document.getElementById('Garden-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Garden + '"]');
        let slider = new Slider('#Garden-slider',{
        });
        $( ".GardenOfferSearch" ).children().addClass("white");
    }
    if ($("#Verandah-slider").is(":visible")) {
        let all = Translator.trans("All");
        let Verandah = Translator.trans("With Verandah");
        let id = document.getElementById('Verandah-slider');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Verandah + '"]');
        let slider = new Slider('#Verandah-slider',{
        });
        $( ".VerandahOfferSearch" ).children().addClass("white");
    }
    if ($("#numberOfHead-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfHead').options;
        let last = (idOptions.length)-1;
        let numberOfDoors = new Slider('#numberOfHead-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfPersson-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfPersson').options;
        let last = (idOptions.length)-1;
        let numberOfPersson = new Slider('#numberOfPersson-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#number-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_number').options;
        let last = (idOptions.length)-1;
        let placeholder = $('#offer_search_number option:selected').text();
        $("#numberOfferSearch").text(placeholder);
        let numberOfPersson = new Slider('#number-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfRooms-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfRooms').options;
        let last = (idOptions.length)-1;
        let numberOfRooms = new Slider('#numberOfRooms-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#AreaMinMax-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_maxArea').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }
        let last = Options.length;
        let value = [Options[0], Options[last - 1]];

        let placeholder = $('#offer_search_minArea option:selected').text();
        let title = placeholder.substr(4);
        $("#minMaxAreaOfferSearch").text(toTitleCase(title));
        let area = new Slider("#AreaMinMax-slider", {
            value: value,
            ticks: Options,
        });
    }
    if ($("#classEnergie-slider").is(":visible")) {
        let id = document.getElementById('classEnergie-slider');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classEnergie = new Slider('#classEnergie-slider',{
        });
        $( ".classEnergieOfferSearch" ).children().addClass("white");
    }
    if ($("#classGes-slider").is(":visible")) {
        let id = document.getElementById('classGes-slider');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classGes = new Slider('#classGes-slider',{
        });
        $( ".classGesOfferSearch" ).children().addClass("white");
    }
    if ($("#numberOfDrawer-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfDrawer').options;
        let last = (idOptions.length)-1;
        let numberOfDrawer = new Slider('#numberOfDrawer-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfStaging-slider").is(":visible")) {
        let idOptions = document.getElementById('offer_search_numberOfStaging').options;
        let last = (idOptions.length)-1;
        let numberOfStaging = new Slider('#numberOfStaging-slider',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
}


function addDemandSearchSlider() {

    if ($("#manufacturingYear-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_manufacturingYear').options;
        let firstYear = idOptions.length-1;
        let max = parseInt(idOptions[1].value);
        let min = parseInt(idOptions[firstYear-1].value)-1;

        let manufacturingYear = new Slider("#manufacturingYear-slider-demand", {
            min: min, max: max, value: max, focus: true
        });
    }

    if ($("#changeGear-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let auto = Translator.trans("Automatic");
        let man = Translator.trans("Manual");
        let id = document.getElementById('changeGear-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ auto+'","'+ man + '"]');
        let changeGear = new Slider('#changeGear-slider-demand',{
        });
        $( ".change-gear" ).children().addClass("white");
    }
    if ($("#numberOfPassengers-slider-demand").is(":visible")) {
        let placeholder = $('#demand_search_numberOfPassengers option:selected').text();
        let idOptions = document.getElementById('demand_search_numberOfPassengers').options;
        let last = (idOptions.length)-1;
        $("#numberOfPassengersDemandSearch").text(placeholder);
        let numberOfPassengers = new Slider('#numberOfPassengers-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfDoors-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfDoors').options;
        let last = (idOptions.length)-1;
        let placeholder = $('#demand_search_numberOfDoors option:selected').text();
        $("#numberOfDoorsDemandSearch").text(placeholder);
        let numberOfDoors = new Slider('#numberOfDoors-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }

    if ($("#workHours-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let full = Translator.trans("Full");
        let partial = Translator.trans("Partial");
        let id = document.getElementById('workHours-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ full+'","'+ partial + '"]');
        let workHours = new Slider('#workHours-slider-demand',{
        });
        $( ".workHoursDemandSearch" ).children().addClass("white");
    }
    if ($("#dvdCd-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let dvd = Translator.trans("DVD");
        let cd = Translator.trans("CD");
        let id = document.getElementById('dvdCd-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ dvd +'","'+ cd + '"]');
        let dvdCd = new Slider('#dvdCd-slider-demand',{
        });
        $( ".dvdCdDemandSearch" ).children().addClass("white");
    }
    if ($("#ram-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_ram').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }

        let placeholder = $('#demand_search_ram option:selected').text();

        $("#ramDemandSearch").text(placeholder);
        let ram = new Slider("#ram-slider-demand", {
            ticks: Options,
            value:0
        });
    }
    if ($("#capacity-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_capacity').options;
        let Options = [0];
        for (let i = 1; i < idOptions.length; i++) {
            Options.push(parseInt(idOptions[i].value));
        }

        let placeholder = $('#demand_search_capacity option:selected').text();

        $("#capacityDemandSearch").text(placeholder);
        let ram = new Slider("#capacity-slider-demand", {
            ticks: Options,
            value:0
        });
    }
    if ($("#wifi-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let wifi = Translator.trans("Wifi");
        let id = document.getElementById('wifi-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ wifi + '"]');
        let slider = new Slider('#wifi-slider-demand',{
        });
        $( ".wifiDemandSearch" ).children().addClass("white");
    }
    if ($("#accessories-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let accessories = Translator.trans("Accessories");
        let id = document.getElementById('accessories-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ accessories + '"]');
        let slider = new Slider('#accessories-slider-demand',{
        });
        $( ".accessoriesDemandSearch" ).children().addClass("white");
    }
    if ($("#hdmi-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let hdmi = Translator.trans("Hdmi");
        let id = document.getElementById('hdmi-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ hdmi + '"]');
        let slider = new Slider('#hdmi-slider-demand',{
        });
        $( ".hdmiDemandSearch" ).children().addClass("white");
    }
    if ($("#cdRoom-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let cdRoom = Translator.trans("Cd Room");
        let id = document.getElementById('cdRoom-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ cdRoom + '"]');
        let slider = new Slider('#cdRoom-slider-demand',{
        });
        $( ".cdRoomDemandSearch" ).children().addClass("white");
    }
    if ($("#usb-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let usb = Translator.trans("Usb");
        let id = document.getElementById('usb-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ usb + '"]');
        let slider = new Slider('#usb-slider-demand',{
        });
        $( ".usbDemandSearch" ).children().addClass("white");
    }
    if ($("#covered-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let covered = Translator.trans("Covered");
        let id = document.getElementById('covered-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ covered + '"]');
        let slider = new Slider('#covered-slider-demand',{
        });
        $( ".coveredDemandSearch" ).children().addClass("white");
    }
    if ($("#electricHead-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let electricHead = Translator.trans("Electric Head");
        let id = document.getElementById('electricHead-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ electricHead + '"]');
        let slider = new Slider('#electricHead-slider-demand',{
        });
        $( ".electricHeadDemandSearch" ).children().addClass("white");
    }
    if ($("#threeInOne-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let threeInOne = Translator.trans("Three In One");
        let id = document.getElementById('threeInOne-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ threeInOne + '"]');
        let slider = new Slider('#threeInOne-slider-demand',{
        });
        $( ".threeInOneDemandSearch" ).children().addClass("white");
    }
    if ($("#Oven-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let withOven = Translator.trans("With Oven");
        let id = document.getElementById('Oven-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withOven + '"]');
        let slider = new Slider('#Oven-slider-demand',{
        });
        $( ".OvenDemandSearch" ).children().addClass("white");
    }
    if ($("#Elevator-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let withElevator = Translator.trans("With Elevator");
        let id = document.getElementById('Elevator-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withElevator + '"]');
        let slider = new Slider('#Elevator-slider-demand',{
        });
        $( ".ElevatorDemandSearch" ).children().addClass("white");
    }
    if ($("#Freezer-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let withFreezer = Translator.trans("With Freezer");
        let id = document.getElementById('Freezer-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ withFreezer + '"]');
        let slider = new Slider('#Freezer-slider-demand',{
        });
        $( ".FreezerDemandSearch" ).children().addClass("white");
    }
    if ($("#Furniture-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let Furniture = Translator.trans("With Furniture");
        let id = document.getElementById('Furniture-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Furniture + '"]');
        let slider = new Slider('#Furniture-slider-demand',{
        });
        $( ".FurnitureDemandSearch" ).children().addClass("white");
    }
    if ($("#Garden-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let Garden = Translator.trans("With Garden");
        let id = document.getElementById('Garden-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Garden + '"]');
        let slider = new Slider('#Garden-slider-demand',{
        });
        $( ".GardenDemandSearch" ).children().addClass("white");
    }
    if ($("#Verandah-slider-demand").is(":visible")) {
        let all = Translator.trans("All");
        let Verandah = Translator.trans("With Verandah");
        let id = document.getElementById('Verandah-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["'+ all +'","'+ Verandah + '"]');
        let slider = new Slider('#Verandah-slider-demand',{
        });
        $( ".VerandahDemandSearch" ).children().addClass("white");
    }
    if ($("#numberOfHead-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfHead').options;
        let last = (idOptions.length)-1;
        let placeholder = $('#demand_search_numberOfHead option:selected').text();

        $("#numberOfHeadDemandSearch").text(placeholder);
        let numberOfDoors = new Slider('#numberOfHead-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfPersson-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfPersson').options;
        let last = (idOptions.length)-1;
        let numberOfPersson = new Slider('#numberOfPersson-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#number-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_number').options;
        let last = (idOptions.length)-1;
        let placeholder = $('#demand_search_number option:selected').text();
        $("#numberDemandSearch").text(placeholder);
        let numberOfPersson = new Slider('#number-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfRooms-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfRooms').options;
        let last = (idOptions.length)-1;
        let placeholder = $('#demand_search_numberOfRooms option:selected').text();
        $("#numberOfRoomsDemandSearch").text(placeholder);
        let numberOfRooms = new Slider('#numberOfRooms-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#classEnergie-slider-demand").is(":visible")) {
        let id = document.getElementById('classEnergie-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classEnergie = new Slider('#classEnergie-slider-demand',{
        });
        $( ".classEnergieDemandSearch" ).children().addClass("white");
    }
    if ($("#classGes-slider-demand").is(":visible")) {
        let id = document.getElementById('classGes-slider-demand');
        id.setAttribute('data-slider-ticks-labels','["All", "A", "B", "C", "D", "E", "F", "G"]');
        let classGes = new Slider('#classGes-slider-demand',{
        });
        $( ".classGesDemandSearch" ).children().addClass("white");
    }
    if ($("#numberOfDrawer-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfDrawer').options;
        let last = (idOptions.length)-1;
        let numberOfDrawer = new Slider('#numberOfDrawer-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }
    if ($("#numberOfStaging-slider-demand").is(":visible")) {
        let idOptions = document.getElementById('demand_search_numberOfStaging').options;
        let last = (idOptions.length)-1;
        let numberOfStaging = new Slider('#numberOfStaging-slider-demand',{
            min: 0,
            max: last,
            value: 0,
            focus: true
        });
    }

}

function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

$(document).ready(function () {
    //hosting//
    let idPerson = document.getElementById('hosting_search_numberOfPersons').options;
    let lastPerson = (idPerson.length)-1;
    let numberOfPersons = new Slider('#numberOfPerson-slider-hosting',{
        min: 0,
        max: lastPerson,
        value: 0,
        focus: true
    });

    let idDays = document.getElementById('hosting_search_numberOfDays').options;
    let lastDays = (idDays.length)-1;
    let numberOfDays = new Slider('#numberOfDays-slider-hosting',{
        min: 0,
        max: lastDays,
        value: 0,
        focus: true
    });
    //end hosting//

});
function hideElementsOfferSearch() {
    let items = $('[id^="section"]');
    if(items.length>3){
        for (let i=3;i<items.length;i++){
            let id=$(items[i]).attr('id');
            $('#'+id).addClass('d-none');
        }
        let button= $('<div class="search-down"><a class="float-right" id="offer-more">\n' +
            '<i id="more-down" class="far fa-arrow-alt-circle-down mt-3 "></i>\n' +
            '</a></div>');
        $("#search_offer_dynamic").append(button);
        let button_status = 'down';

        $('#offer-more').on('click',function(){

            if(button_status === 'down'){
                $('#more-down').removeClass('fa-arrow-alt-circle-down');
                $('#more-down').addClass('fa-arrow-alt-circle-up');
                button_status = 'up';
            }
            else{
                $('#more-down').addClass('fa-arrow-alt-circle-down');
                $('#more-down').removeClass('fa-arrow-alt-circle-up');
                button_status = 'down';
            }

            for (let i=3;i<items.length;i++){
                let id=$(items[i]).attr('id');
                $('#'+id).toggleClass('d-none');
            }
        });
    }
}
function hideElementsDemandSearch() {
    let items = $('[id^="demand-section"]');
    console.log(items.length);
    if(items.length>4){
        for (let i=4;i<items.length;i++){
            let id=$(items[i]).attr('id');
            $('#'+id).addClass('d-none');
        }
        let button= $('<div class="search-down"><a class="float-right" id="demand-more">\n' +
            '<i id="more-down-demand" class="far fa-arrow-alt-circle-down mt-3 "></i>\n' +
            '</a></div>');
        $("#search_demand_dynamic").append(button);
        let button_status = 'down';

        $('#demand-more').on('click',function(){

            if(button_status === 'down'){
                $('#more-down-demand').removeClass('fa-arrow-alt-circle-down');
                $('#more-down-demand').addClass('fa-arrow-alt-circle-up');
                button_status = 'up';
            }
            else{
                $('#more-down-demand').addClass('fa-arrow-alt-circle-down');
                $('#more-down-demand').removeClass('fa-arrow-alt-circle-up');
                button_status = 'down';
            }

            for (let i=4;i<items.length;i++){
                let id=$(items[i]).attr('id');
                $('#'+id).toggleClass('d-none');
            }
        });
    }
}
export {addOfferSearchSlider,hideElementsOfferSearch,addDemandSearchSlider,hideElementsDemandSearch};