<?php

/*
 * ======================================
 * Multi-field validation functions
 * ======================================
 */

function validateCreateLost($location, $room, $dateLost, $name, $description, $category, $color, $reward, $make, $model) {
    #create new array of list of errors, if any error is returned, form submission should be aborted
    $errorArray = array();

    if (validateLocation($location) == false) {
        array_push($errorArray, 'location');
    }

    #field not required, don't display error if empty
    if(!empty($room)){
        #validate non empty string
        if (validateString($room, 6) == false ) {
            array_push($errorArray, 'room');
        }
    }

    #field not required, don't display error if empty
    if(!empty($dateLost)){
        #validate non empty string
        if(validateDate($dateLost) == false){
            array_push($errorArray, 'date');
        }
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

    #field not required, don't display error if empty
    if(!empty($color)){
        #validate non empty string
        if(validateString($color, 10) == false){
            array_push($errorArray, 'color');
        }
    }

    #field not required, don't display error if empty
    if(!empty($reward)){
        #validate non empty numeric
        if(validateMonetary($reward,100) == false){
            array_push($errorArray, 'reward');
        }
    }

    #field not required, don't display error if empty
    if(!empty($make)){
        #validate non empty string
        if(validateString($make, 15) == false){
            array_push($errorArray, 'make');
        }
    }

    #field not required, don't display error if empty
    if(!empty($model)){
        #validate non empty string
        if(validateString($model, 15) == false){
            array_push($errorArray, 'model');
        }
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
    ) ;
    #in array
    if(in_array($location, $campusLocations)) {
        return true;
    }
    #not in array
    else{ return false; }
}

#checks if argument is a valid date format
function validateDate($date){
    #check if the array can be split
    if(preg_split('-', $date) == true){
        #split the string into array
        $dateArray = array(preg_split('-',$date));
        if(checkdate($dateArray[0], $dateArray[1], $dateArray[2])){
            return true;
        }
        else {return false ;}
    }
    else {
        return false;
    }
}

#if string is alphanumeric and if it's under desired number of characters
function validateString($string, $length){
    $string = trim($string);
    #check if alphanumeric
    if((ctype_alnum($string) == true) && (count($string) <= $length )) {
        return true;
    }
    else {return false;}
}

function validateCategory($category){
    $itemCategories = array("phone or computer", "audio or headphones", "clothing", "notebook or books", "bag or backpack", "other") ;
    if(in_array($category, $itemCategories)) {
        return true;
    }
    else {return false;}
}

function validateMonetary($amount, $limit) {
    $amount = trim($amount);
    if((is_numeric($amount)) && ($amount >= 0) && ($amount <= $limit)){
        return true;
    }
    else{
        return false;
    }

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