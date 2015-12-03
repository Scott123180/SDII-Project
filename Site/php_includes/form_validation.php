<?php

$location = $_POST['campLoc'];
$room = $_POST['room'];
$dateLost = $_POST['date_lost'];
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['iCat'];
$color = $_POST['color'];
$reward = $_POST['reward'];

#checks to see if location is at Marist
function validateLocation($location) {

}

#checks if argument is a valid date format
function validateDate($date){

}

#if string is alphanumeric and if it's under desired number of characters
function validString($string, $length){
    trim($string);
}

function validCategory($category){

}

function validMonetary($amount, $limit) {
    trim($amount);
}

#NEED TO EDIT Carried over from helpers
function valid_number($num) {
    if(empty($num) || !is_numeric($num))
        return false ;
    else {
        $num = intval($num) ;
        if($num <= 0)
            return false ;
    }
    return true ;
}

#NEED TO EDIT Carried over from helpers
function valid_name($name) {
    if (empty($name)) {
        return false;
    } else {return true;}
}


#valid input arrays
$campusLocations = array(
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
    'st. anns hermitage', #st. ann's hermitage
    'st. peters', #st. peter's
    'sheahan hall',
    'steel plant art studios and gallery',
    'student center/rotunda',
    'tennis pavilion',
    'tenney stadium',
    'lower townhouses',
    'lower west cedar townhouses',
    'upper west cedar townhouses'
);

$timeRanges = array("today", "yesterday", "2 to 7 days", "more than a week") ;

$itemCategories = array("phone or computer", "audio or headphones", "clothing", "notebook or books", "bag or backpack", "other") ;


?>