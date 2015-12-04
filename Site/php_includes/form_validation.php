<?php

/*
 * ======================================
 * Multi-field validation functions
 * ======================================
 */

function validateCreateLost($location, $room, $dateLost, $name, $description, $category, $color, $reward) {
    #create new array of list of errors, if any error is returned, form submission should be aborted
    $errorArray = array();
    #
    if (validateLocation($location) == false) {
        array_push($errorArray, 'location');
    }
    if (validateString($room, 6) == false ) {
        array_push($errorArray, 'room');
        }
    if(validateDate($dateLost) == false){
        array_push($errorArray, 'date');
    }
    if(validateString($name, 15) == false) {
        array_push($errorArray, 'name');
    }
    if(validateString($description, 350) == false){
        array_push($errorArray, 'description');
    }
    if(validateCategory($category) == false){
        array_push($errorArray, 'category');
    }
    if(validateString($color, 10) == false){
        array_push($errorArray, 'color');
    }
    if(validateMonetary($reward,100) == false){
        array_push($errorArray, 'reward');
    }
    return $errorArray;
}

/*
 * ======================================
 * Individual validation functions
 * ======================================
 */
#checks to see if location is at Marist
function validateLocation($location) {
    return false;
}

#checks if argument is a valid date format
function validateDate($date){
    return false;
}

#if string is alphanumeric and if it's under desired number of characters
function validateString($string, $length){
    trim($string);
    return false;
}

function validateCategory($category){
    return false;
}

function validateMonetary($amount, $limit) {
    trim($amount);
    return false;
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