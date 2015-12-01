/*
Authors: Scott Hansen and Nicholas Burd
Title: helpers.js
Description: simple file for js functions
 */

//array of categories of items
var itemCategories ;

//array of time ranges for item
var timeRanges ;

//array of campus locations
var campusLocations ;

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

