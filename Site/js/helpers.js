/*
Authors: Scott Hansen and Nicholas Burd
Title: helpers.js
Description: simple file for js functions
 */

//array of categories of items
/*
 * build the javascript array needed in makeOptions()
 */

//create php location array
var itemCategories = [
    'byrne house',
    'james a. cannavino library',
    'champagnat hall',
    'our lady seat of wisdom chapel',
    'cornell boathouse',
    'donnelly hall',
    'margaret m. and charles h. dyson center',
    'fern tor',
    'fontaine hall',
    'foy townhouses',
    'fulton street townhouses',
    'lower fulton townhouses',
    'gartland appartments',
    'greystone hall',
    'hancock center',
    'kieran gatehouse',
    'kirk house',
    'leo hall',
    'longview park',
    'lowell thomas communications center',
    'marian hall',
    'marist boathouse',
    'james j. mccann recreational center',
    'mid-rise hall',
    'st. anns hermitage', //st. ann's hermitage
    'st. peters', //st. peter's
    'sheahan hall',
    'steel plant art studios and gallery',
    'student center/rotunda',
    'tennis pavilion',
    'tenney stadium',
    'lower townhouses',
    'lower west cedar townhouses',
    'upper west cedar townhouses'
];




//array of time ranges for item
var timeRanges = ["today", "yesterday", "2 to 7 days", "more than a week"] ;

//array of campus locations
var campusLocations = ["phone or computer", "audio or headphones", "clothing", "notebook or books", "bag or backpack", "other"] ;

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

