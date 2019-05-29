// regx for search bar


$(document).ready(function () {
    $("#Demand").validate(
        {
            rules: {
                'demand[minManufacturingYear]': {moinDe: '#demand_maxManufacturingYear'},
                'demand[maxManufacturingYear]': {plusDe: '#demand_minManufacturingYear'},
                'demand[minKilometer]':         {moinDe: '#demand_maxKilometer'},
                'demand[maxKilometer]':         {plusDe: '#demand_minKilometer'},
                'demand[minArea]':              {moinDe: '#demand_maxArea'},
                'demand[maxArea]':              {plusDe: '#demand_minArea'},
                'demand[price]':                { regex: /^([0-9]{0,8})$/},
                'demand[model]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand[brand]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand[age]':                  { regex: /^([0-9]{0,2})$/},
                'demand[manufactureCompany]':   { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand[subjectName]':          { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand[salary]':               { regex: /^([0-9]{0,4})$/},
                'demand[material]':             { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand[screenSizeCm]':         { regex: /^([0-9]{0,3})$/},
                'demand[screenSizeInch]':       { regex: /^([0-9]{0,3})$/},
                'demand[accuracy]':             { regex: /^([0-9]{0,4})$/},
                'demand[weight]':               { regex: /^([0-9]{0,2})$/},
                'demand[capacity]':             { regex: /^([0-9]{0,4})$/},
                'demand[animalSpecies]':        { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                /*search_demand*/
                'demand[kilometer]':            { regex: /^([0-9]{0,8})$/},
                'demand[area]':                 { regex: /^([0-9]{0,4})$/},
                /*offer*/
                'demand[color]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand[ability]':              { regex: /^([0-9.]{0,4})$/},
                'demand[mission]':              { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand[processor]':            { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand[length]':               { regex: /^([0-9.]{0,3})$/},
                'demand[width]':                { regex: /^([0-9.]{0,3})$/},
                'demand[height]':               { regex: /^([0-9.]{0,3})$/},
                'demand[caliber]':              { regex: /^([0-9.]{0,3})$/},
            },
            messages: {
                'demand[model]':              {'regex': "No Numeric and special characters allowed."},
                'demand[price]':              {'regex': "8 Numeric characters only."},
                'demand[brand]':              {'regex': "No Numeric and special characters allowed."},
                'demand[age]':                {'regex': "2 Numeric characters only."},
                'demand[manufactureCompany]': {'regex': "No Numeric and special characters allowed."},
                'demand[subjectName]':        {'regex': "No special characters allowed."},
                'demand[salary]':             {'regex': "4 Numeric characters only."},
                'demand[material]':           { 'regex':'No special characters allowed.'},
                'demand[screenSizeCm]':       { 'regex':'3 Numeric characters only.'},
                'demand[screenSizeInch]':     { 'regex':'3 Numeric characters only.'},
                'demand[accuracy]':           { 'regex':'4 Numeric characters only.'},
                'demand[weight]':             { 'regex':'2 Numeric characters only.'},
                'demand[capacity]':           { 'regex':'4 Numeric characters only.'},
                'demand[animalSpecies]':      { 'regex':'No Numeric and special characters allowed.'},
                /*search_demand*/
                'demand[kilometer]':          { 'regex':'6 Numeric characters only.'},
                'demand[area]':               { 'regex':'4 Numeric characters only.'},
                /*offer*/
                'demand[color]':              { 'regex':'No Numeric and special characters allowed.'},
                'demand[ability]':            { 'regex':'4 Numeric characters only.'},
                'demand[mission]':            { 'regex':'No Numeric and special characters allowed.'},
                'demand[processor]':          { 'regex':'No special characters allowed.'},
                'demand[length]':             { 'regex':'3 Numeric characters only.'},
                'demand[width]':              { 'regex' :'3 Numeric characters only.'},
                'demand[height]':             { 'regex':'3 Numeric characters only.'},
                'demand[caliber]':            { 'regex':'3 Numeric characters only.'},
            },
        }
    );
});
$(document).ready(function () {
    $("#Offer").validate(
        {
            rules: {
                'offer[minManufacturingYear]': {moinDe: '#offer_maxManufacturingYear'},
                'offer[maxManufacturingYear]': {plusDe: '#offer_minManufacturingYear'},
                'offer[minKilometer]':         {moinDe: '#offer_maxKilometer'},
                'offer[maxKilometer]':         {plusDe: '#offer_minKilometer'},
                'offer[minArea]':              {moinDe: '#offer_maxArea'},
                'offer[maxArea]':              {plusDe: '#offer_minArea'},
                'offer[price]':                { regex: /^([0-9]{0,8})$/},
                'offer[model]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer[brand]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer[age]':                  { regex: /^([0-9]{0,2})$/},
                'offer[manufactureCompany]':   { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer[subjectName]':          { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer[salary]':               { regex: /^([0-9]{0,4})$/},
                'offer[material]':             { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer[screenSizeCm]':         { regex: /^([0-9]{0,3})$/},
                'offer[screenSizeInch]':       { regex: /^([0-9]{0,3})$/},
                'offer[accuracy]':             { regex: /^([0-9]{0,4})$/},
                'offer[weight]':               { regex: /^([0-9]{0,2})$/},
                'offer[capacity]':             { regex: /^([0-9]{0,4})$/},
                'offer[animalSpecies]':        { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                /*search_offer*/
                'offer[kilometer]':            { regex: /^([0-9]{0,8})$/},
                'offer[area]':                 { regex: /^([0-9]{0,4})$/},
                /*offer*/
                'offer[color]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer[ability]':              { regex: /^([0-9.]{0,4})$/},
                'offer[mission]':              { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer[processor]':            { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer[length]':               { regex: /^([0-9.]{0,3})$/},
                'offer[width]':                { regex: /^([0-9.]{0,3})$/},
                'offer[height]':               { regex: /^([0-9.]{0,3})$/},
                'offer[caliber]':              { regex: /^([0-9.]{0,3})$/},
            },
            messages: {
                'offer[model]':              {'regex': "No Numeric and special characters allowed."},
                'offer[price]':              {'regex': "8 Numeric characters only."},
                'offer[brand]':              {'regex': "No Numeric and special characters allowed."},
                'offer[age]':                {'regex': "2 Numeric characters only."},
                'offer[manufactureCompany]': {'regex': "No Numeric and special characters allowed."},
                'offer[subjectName]':        {'regex': "No special characters allowed."},
                'offer[salary]':             {'regex': "4 Numeric characters only."},
                'offer[material]':           { 'regex':'No special characters allowed.'},
                'offer[screenSizeCm]':       { 'regex':'3 Numeric characters only.'},
                'offer[screenSizeInch]':     { 'regex':'3 Numeric characters only.'},
                'offer[accuracy]':           { 'regex':'4 Numeric characters only.'},
                'offer[weight]':             { 'regex':'2 Numeric characters only.'},
                'offer[capacity]':           { 'regex':'4 Numeric characters only.'},
                'offer[animalSpecies]':      { 'regex':'No Numeric and special characters allowed.'},
                /*search_offer*/
                'offer[kilometer]':          { 'regex':'6 Numeric characters only.'},
                'offer[area]':               { 'regex':'4 Numeric characters only.'},
                /*offer*/
                'offer[color]':              { 'regex':'No Numeric and special characters allowed.'},
                'offer[ability]':            { 'regex':'4 Numeric characters only.'},
                'offer[mission]':            { 'regex':'No Numeric and special characters allowed.'},
                'offer[processor]':          { 'regex':'No special characters allowed.'},
                'offer[length]':             { 'regex':'3 Numeric characters only.'},
                'offer[width]':              { 'regex' :'3 Numeric characters only.'},
                'offer[height]':             { 'regex':'3 Numeric characters only.'},
                'offer[caliber]':            { 'regex':'3 Numeric characters only.'},
            },
        }
    );
});
$(document).ready(function () {
    $("#search-offer").validate(
        {

            rules: {
                'offer_search[minManufacturingYear]': {moinDe: '#offer_search_maxManufacturingYear'},
                'offer_search[maxManufacturingYear]': {plusDe: '#offer_search_minManufacturingYear'},
                'offer_search[minKilometer]':         {moinDe: '#offer_search_maxKilometer'},
                'offer_search[maxKilometer]':         {plusDe: '#offer_search_minKilometer'},
                'offer_search[minArea]':              {moinDe: '#offer_search_maxArea'},
                'offer_search[maxArea]':              {plusDe: '#offer_search_minArea'},
                'offer_search[price]':                { regex: /^([0-9]{0,8})$/},
                'offer_search[model]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer_search[brand]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer_search[age]':                  { regex: /^([0-9]{0,2})$/},
                'offer_search[manufactureCompany]':   { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer_search[subjectName]':          { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer_search[salary]':               { regex: /^([0-9]{0,4})$/},
                'offer_search[material]':             { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer_search[screenSizeCm]':         { regex: /^([0-9]{0,3})$/},
                'offer_search[screenSizeInch]':       { regex: /^([0-9]{0,3})$/},
                'offer_search[accuracy]':             { regex: /^([0-9]{0,4})$/},
                'offer_search[weight]':               { regex: /^([0-9]{0,2})$/},
                'offer_search[capacity]':             { regex: /^([0-9]{0,4})$/},
                'offer_search[animalSpecies]':        { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                /*search_demand*/
                'offer_search[kilometer]':            { regex: /^([0-9]{0,8})$/},
                'offer_search[area]':                 { regex: /^([0-9]{0,4})$/},
                /*offer*/
                'offer_search[color]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer_search[ability]':              { regex: /^([0-9.]{0,4})$/},
                'offer_search[mission]':              { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'offer_search[processor]':            { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'offer_search[length]':               { regex: /^([0-9.]{0,3})$/},
                'offer_search[width]':                { regex: /^([0-9.]{0,3})$/},
                'offer_search[height]':               { regex: /^([0-9.]{0,3})$/},
                'offer_search[caliber]':              { regex: /^([0-9.]{0,3})$/},
            },
            messages: {
                'offer_search[model]':              {'regex': "No Numeric and special characters allowed."},
                'offer_search[price]':              {'regex': "8 Numeric characters only."},
                'offer_search[brand]':              {'regex': "No Numeric and special characters allowed."},
                'offer_search[age]':                {'regex': "2 Numeric characters only."},
                'offer_search[manufactureCompany]': {'regex': "No Numeric and special characters allowed."},
                'offer_search[subjectName]':        {'regex': "No special characters allowed."},
                'offer_search[salary]':             {'regex': "4 Numeric characters only."},
                'offer_search[material]':           { 'regex':'No special characters allowed.'},
                'offer_search[screenSizeCm]':       { 'regex':'3 Numeric characters only.'},
                'offer_search[screenSizeInch]':     { 'regex':'3 Numeric characters only.'},
                'offer_search[accuracy]':           { 'regex':'4 Numeric characters only.'},
                'offer_search[weight]':             { 'regex':'2 Numeric characters only.'},
                'offer_search[capacity]':           { 'regex':'4 Numeric characters only.'},
                'offer_search[animalSpecies]':      { 'regex':'No Numeric and special characters allowed.'},
                /*search_demand*/
                'offer_search[kilometer]':          { 'regex':'6 Numeric characters only.'},
                'offer_search[area]':               { 'regex':'4 Numeric characters only.'},
                /*offer*/
                'offer_search[color]':              { 'regex':'No Numeric and special characters allowed.'},
                'offer_search[ability]':            { 'regex':'4 Numeric characters only.'},
                'offer_search[mission]':            { 'regex':'No Numeric and special characters allowed.'},
                'offer_search[processor]':          { 'regex':'No special characters allowed.'},
                'offer_search[length]':             { 'regex':'3 Numeric characters only.'},
                'offer_search[width]':              { 'regex' :'3 Numeric characters only.'},
                'offer_search[height]':             { 'regex':'3 Numeric characters only.'},
                'offer_search[caliber]':            { 'regex':'3 Numeric characters only.'},
            },
        }
    );
});

$(document).ready(function () {
    $("#search-demand").validate(
        {

            rules: {
                'demand_search[minManufacturingYear]': {moinDe: '#demand_search_maxManufacturingYear'},
                'demand_search[maxManufacturingYear]': {plusDe: '#demand_search_minManufacturingYear'},
                'demand_search[minKilometer]':         {moinDe: '#demand_search_maxKilometer'},
                'demand_search[maxKilometer]':         {plusDe: '#demand_search_minKilometer'},
                'demand_search[minArea]':              {moinDe: '#demand_search_maxArea'},
                'demand_search[maxArea]':              {plusDe: '#demand_search_minArea'},
                'demand_search[price]':                { regex: /^([0-9]{0,8})$/},
                'demand_search[model]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand_search[brand]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand_search[age]':                  { regex: /^([0-9]{0,2})$/},
                'demand_search[manufactureCompany]':   { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand_search[subjectName]':          { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand_search[salary]':               { regex: /^([0-9]{0,4})$/},
                'demand_search[material]':             { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand_search[screenSizeCm]':         { regex: /^([0-9]{0,3})$/},
                'demand_search[screenSizeInch]':       { regex: /^([0-9]{0,3})$/},
                'demand_search[accuracy]':             { regex: /^([0-9]{0,4})$/},
                'demand_search[weight]':               { regex: /^([0-9]{0,2})$/},
                'demand_search[capacity]':             { regex: /^([0-9]{0,4})$/},
                'demand_search[animalSpecies]':        { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                /*search_demand*/
                'demand_search[kilometer]':            { regex: /^([0-9]{0,8})$/},
                'demand_search[area]':                 { regex: /^([0-9]{0,4})$/},
                /*demand*/
                'demand_search[color]':                { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand_search[ability]':              { regex: /^([0-9.]{0,4})$/},
                'demand_search[mission]':              { regex: /^\s*[a-zA-Z,\s]+\s*$/},
                'demand_search[processor]':            { regex: /^\s*[a-zA-Z0-9,\s]+\s*$/},
                'demand_search[length]':               { regex: /^([0-9.]{0,3})$/},
                'demand_search[width]':                { regex: /^([0-9.]{0,3})$/},
                'demand_search[height]':               { regex: /^([0-9.]{0,3})$/},
                'demand_search[caliber]':              { regex: /^([0-9.]{0,3})$/},
            },
            messages: {
                'demand_search[model]':              {'regex': "No Numeric and special characters allowed."},
                'demand_search[price]':              {'regex': "8 Numeric characters only."},
                'demand_search[brand]':              {'regex': "No Numeric and special characters allowed."},
                'demand_search[age]':                {'regex': "2 Numeric characters only."},
                'demand_search[manufactureCompany]': {'regex': "No Numeric and special characters allowed."},
                'demand_search[subjectName]':        {'regex': "No special characters allowed."},
                'demand_search[salary]':             {'regex': "4 Numeric characters only."},
                'demand_search[material]':           { 'regex':'No special characters allowed.'},
                'demand_search[screenSizeCm]':       { 'regex':'3 Numeric characters only.'},
                'demand_search[screenSizeInch]':     { 'regex':'3 Numeric characters only.'},
                'demand_search[accuracy]':           { 'regex':'4 Numeric characters only.'},
                'demand_search[weight]':             { 'regex':'2 Numeric characters only.'},
                'demand_search[capacity]':           { 'regex':'4 Numeric characters only.'},
                'demand_search[animalSpecies]':      { 'regex':'No Numeric and special characters allowed.'},
                /*search_demand*/
                'demand_search[kilometer]':          { 'regex':'6 Numeric characters only.'},
                'demand_search[area]':               { 'regex':'4 Numeric characters only.'},
                /*demand*/
                'demand_search[color]':              { 'regex':'No Numeric and special characters allowed.'},
                'demand_search[ability]':            { 'regex':'4 Numeric characters only.'},
                'demand_search[mission]':            { 'regex':'No Numeric and special characters allowed.'},
                'demand_search[processor]':          { 'regex':'No special characters allowed.'},
                'demand_search[length]':             { 'regex':'3 Numeric characters only.'},
                'demand_search[width]':              { 'regex' :'3 Numeric characters only.'},
                'demand_search[height]':             { 'regex':'3 Numeric characters only.'},
                'demand_search[caliber]':            { 'regex':'3 Numeric characters only.'},
            },
        }
    );
});

$.validator.addMethod( "moinDe", function( value, element, param ) {
    var target = $( param );
    if ( this.settings.onfocusout && target.not( ".validate-lessThanEqual-blur" ).length ) {
        target.addClass( "validate-lessThanEqual-blur" ).on( "blur.validate-lessThanEqual", function() {
            $( element ).valid();
        } );
    }
    if(target.val()=== ''){
        return true;
    }
    else {
        return parseInt(value) <= parseInt(target.val()) ;
    }
}, "The minimum is greater than the maximum." );

$.validator.addMethod( "plusDe", function( value, element, param ) {
    var target = $( param );
    if ( this.settings.onfocusout && target.not( ".validate-lessThanEqual-blur" ).length ) {
        target.addClass( "validate-lessThanEqual-blur" ).on( "blur.validate-lessThanEqual", function() {
            $( element ).valid();
        } );
    }
    if(target.val()=== ''){
        return true;
    }
    else {
        return parseInt(value) >= parseInt(target.val()) ;
    }
}, "The maximum is less than the minimum." );

$.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    },"erreur expression reguliere"
);
