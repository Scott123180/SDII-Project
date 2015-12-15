<?php

/*
 * ======================================
 * Multi-field validation functions
 * ======================================
 */

function validateCreateLost($location, $room, $dateLost, $name, $description, $category, $color, $reward, $make, $model, $contact_name, $contact_email) {
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
    if(validateString($description, 199) == false){
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

    #valid contact name
    if(validateString($contact_name, 30) == false){
        array_push($errorArray, 'contact name');
    }

    #validate email input
    if(validateEmail($contact_email) == false){
        array_push($errorArray, 'contact email');
    }

    return $errorArray;
}

function validateCreateFound($location, $room, $name, $description, $category, $color, $make, $model, $contact_name, $contact_email) {
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

    if(validateString($name, 15) == false) {
        array_push($errorArray, 'name');
    }
    if(validateString($description, 199) == false){
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

    #valid contact name
    if(validateString($contact_name, 30) == false){
        array_push($errorArray, 'contact name');
    }

    #validate email input
    if(validateEmail($contact_email) == false){
        array_push($errorArray, 'contact email');
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
    global $campusLocations;
    #in array
    if(in_array($location, $campusLocations)) {
        return true;
    }
    #not in array
    else{ return false; }
}

#checks if argument is a valid date format
function validateDate($date){

    #check if the date is valid
    if(true){
        #split the string into array
        $dateArray = explode('-',$date, 3);
        $year = (int)$dateArray[0];
        $month = (int)$dateArray[1];
        $day = (int)$dateArray[2];
        if(checkdate($month, $day, $year)){
            return true;
        }
        else {return false ;}
    }
    else {
        return false;
    }
    #if there is an error, it will return false
    return false;
}

#if string is alphanumeric and if it's under desired number of characters
function validateString($string, $length){
    $string = trim($string);
    #get rid of spaces so can validate
    $string = str_replace(' ', 'x', $string);
    #check if alphanumeric
    if((ctype_alnum($string) == true) && (strlen($string) <= $length )) {
        return true;
    }
    else {return false;}
}

function validateCategory($category){
    global $itemCategories;
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

#checks to see if a number is a positive number
function validatePosInt($num) {
    #is a positive int
    if (is_int($num) && ($num > 0)){
        return true;
    }
    #not a pos num
    else {return false;}
}

#check for valid email
function validateEmail($email){
    #email valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    #invalid email
    else {return false;}
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