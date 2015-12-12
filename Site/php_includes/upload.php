<?php
#Created by w3schools: http://www.w3schools.com/php/php_file_upload.asp
#Modified by Scott Hansen and Nicholas Burd
$target_dir = "uploads/";
#add unique name
$target_file = $target_dir . uniqueName($target_file) . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submitItem"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size 1MB
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

#add a very unique extension to the file
function uniqueName(){
    #create time stamp for uniqueness
    $date = date_create();
    $timestamp = strval(date_timestamp_get($date)); #convert to string for hash
    $number = strval(rand(0, 1000)); #convert to string for hash
    #combine for the hash
    $hash = $timestamp . $number ;
    $hash = hash('md5', $hash, $raw_output = false);
    return $hash;
}

#get the name for other files to use
function returnName(){
    global $target_file;
    return $target_file;
}

?>