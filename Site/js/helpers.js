/*
Authors: Scott Hansen and Nicholas Burd
Title: helpers.js
Description: simple file for js functions
 */

//grab filtered data and put in the found item form
function grabFoundData() {
    self.location='create_found_item.php';
}

//grab filtered data and put in lost item form
function grabLostData() {
    self.location='create_lost_item.php';
}

//take in an array of strings and the ElementID and create a list of options
function makeOptions(array, id) {

    for (var i = 0; i < array.length; i++) {
        var tag = document.createElement('option');
        var content = document.createTextNode(array[i]);
        tag.appendChild(content);

        var element = document.getElementById(id);

        element.appendChild(tag);
    }
}

//array of categories of items
var itemCategories = ["phone or computer", "audio or headphones", "clothing", "notebook or books", "bag or backpack", "other"] ;

//array of times for how long ago item was lost
var timeRanges = ["today", "yesterday", "2 to 7 days", "longer than a week"] ;

//array of locations on campus
var campusLocations =
[
    "byrne house",
    "james a. cannavino library",
    "champagnat hall",
    "our lady seat of wisdom chapel",
    "cornell boathouse",
    "donnelly hall",
    "margaret m. and charles h. dyson center",
    "fern tor",
    "fontaine hall",
    "foy townhouses",
    "fulton street townhouses",
    "lower fulton townhouses",
    "gartland appartments",
    "greystone hall",
    "hancock center",
    "kieran gatehouse",
    "kirk house",
    "leo hall",
    "longview park",
    "lowell thomas communications center",
    "marian hall",
    "marist boathouse",
    "james j. mccann recreational center",
    "mid-rise hall",
    "st. ann's hermitage",
    "st. peter's",
    "sheahan hall",
    "steel plant art sudios and gallery",
    "student center/rotunda",
    "tennis pavilion",
    "tenney stadium",
    "lower townhouses",
    "lower west cedar townhouses",
    "upper west cedar townhouses"
];