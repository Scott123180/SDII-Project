﻿<?php
session_start();
?>
<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/helpers.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Lost Something</title>
</head>
<body>
<div class="container-fluid" style="background-color:#aaaaaa">
    <div class="row">
        <div class="span4"></div>
        <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/limbocompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
        <div class="span4"></div>
    </div>
</div>

<!--header-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php" style="color:white;"><h4>Lost Something?</h4></a></div>
        <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php" style="color:white;"><h4>Found Something?</h4></a></div>
        <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php" style="color:white;"><h4>About</h4></a></div>
    </div>
</div>

<!--Begin form-->
<div class="container">
    <form class="form-group" method="post" enctype="multipart/form-data">

        <h4>What location did you find it at?<strong style="color: red">*</strong></h4>
        <select class="form-control" name="campLoc" id="campLoc">
            <script>makeOptions(campusLocations, "campLoc")</script>
        </select>

        <h4>What room did you find it in?</h4>
        <input type="text" class="form-control" placeholder="example: 303, 202, et cetera" name="room" value="<?php if(isset($_POST['room'])){echo $_POST['room'];} ?>">

        <h4>What is name of the item?<strong style="color: red">*</strong></h4>
        <input type="text" class="form-control" placeholder="example: scarf, bologna, laptop" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">

        <h4>Please describe the item:<strong style="color: red">*</strong></h4>
        <input type="text" class="form-control" placeholder="description" name="description" value="<?php if(isset($_POST['description'])){echo $_POST['description'];} ?>">

        <h4>Item Category<strong style="color: red">*</strong></h4>
        <select class="form-control" name="iCat" id="iCat">
            <script>makeOptions(itemCategories, "iCat");</script>
        </select>

        <h4>What is the item's make?</h4>
        <input type="text" class="form-control" placeholder="example: apple, microsoft, nordstrom, et. cetera" name="make" value="<?php if(isset($_POST['make'])){echo $_POST['make'];} ?>">

        <h4>What is the item's model?</h4>
        <input type="text" class="form-control" placeholder="example: 6s, Lumia 920, et. cetera" name="model" value="<?php if(isset($_POST['model'])){echo $_POST['model'];} ?>">

        <h4>What is the item's color?</h4>
        <input type="text" class="form-control" placeholder="item color" name="color" value="<?php if(isset($_POST['color'])){echo $_POST['color'];} ?>">

        <h4>What is your name?<strong style="color:red">*</strong></h4>
        <input type="text" class="form-control" placeholder="Your name here" name="contact_name" value="<?php if(isset($_POST['contact_name'])){echo $_POST['contact_name'];} ?>">

        <h4>What is your email?<strong style="color:red">*</strong></h4>
        <input type="text" class="form-control" placeholder="email@example.com" name="contact_email" value="<?php if(isset($_POST['contact_email'])){echo $_POST['contact_email'];} ?>">

        <h4>Select image to upload:</h4>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <p>* indicates that the field is required.</p>

        <div class="g-recaptcha" data-sitekey="6LdO6RITAAAAAFuKe988Gx22njo7BhXkgV3BiA_F"></div>
        <br/>
        <input type="submit" class="form-control" name = "submitItem" value="Submit" style="margin-top: 15px;margin-bottom: 15px" />


        <?php
        # Connect to MySQL server and the database
        require( '../connect_db.php' ) ;

        # Includes these helper functions
        require( 'php_includes/helpers.php' ) ;

        # get all the inputted data
        if(isset($_POST['submitItem'])) {
            #image upload
            require( 'php_includes/upload.php' ) ;

            #only set variables if they are not null
            $location = $_POST['campLoc'];
            $room = $_POST['room'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category = $_POST['iCat'];
            $make = $_POST['make'];
            $model = $_POST['model'];
            $color = $_POST['color'];
            $contact_name = $_POST['contact_name'];
            $contact_email = $_POST['contact_email'];

            $status = 'found' ;
            $image = '';

            #got rid of reward, date_lost

            #set to TRUE for demo purposes
            $captchaResult = TRUE;
            #recaptche
            if(isset($_POST['g-recaptcha-response']) && ($_POST['g-recaptcha-response'])){ #check for the response and that it's not empty
                $secret = '6LdO6RITAAAAAKnfRLq4PBYuyKEIsbjrLQePZWiY'; #secret site key
                $ip = $_SERVER['REMOTE_ADDR']; #get server address
                $captcha = $_POST['g-recaptcha-response']; #get captcha
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip"); #send captcha to Google to verify
                $responseArray = json_decode($response, TRUE); #json to array
                var_dump($responseArray);
                #if successful, change variable to true
                if($responseArray['success'] == TRUE){
                    $captchaResult = TRUE;
                }
            }
            #get error array
            $errors = validateCreateFound($location, $room, $name, $description, $category, $color, $make, $model, $contact_name, $contact_email);
            #if there are no errors
            if(empty($errors) && ($captchaResult == TRUE)){
                global $target_file;
                $image = $target_file;
                #set reward and datelost to empty so don't have to remake function
                $reward = '';
                $dateLost = '';
                #location_id, item_lost_date, item_name, item_description, room, status, item_category, make, model, color, reward
                insert_record($dbc, $location, $dateLost, $name, $description, $room, $status, $category, $make, $model, $color, $reward, $image, $contact_name, $contact_email);
                echo "<p>This is the target file in image: {$image}</p>";

                $_SESSION['contact_name'] = $contact_name;
                $_SESSION['contact_email'] = $contact_email;
                $_SESSION['name'] = $name;
                $_SESSION['description'] = $description;
                $_SESSION['category'] = $category;
                $_SESSION['location'] = $location;
                echo "<a class='btn btn-default' href='found_item_ticket.php' role='button'>Continue To Next Page</a>";
            }
            #print errors for user to see
            else {
                #no errors in fields
                if(!empty($errors)){
                    $errorStatement = 'Please fix errors in these fields: ' ;
                    for($x = 0; $x < count($errors) ; $x++){
                        #last
                        if($x == count($errors) - 1){
                            $errorStatement .= $errors[$x] . '.';
                        }
                        #last error
                        else{
                            $errorStatement .= $errors[$x] . ', ';
                        }
                    }
                    #return the errors
                    echo "<p style='color:red'>" . $errorStatement . "</p>";
                }
                #didn't submit or is a bot
                if($captchaResult == FALSE){
                    #error message
                    echo "<p style='color:red'>Please authorize with reCaptcha</p>";
                }
            }
        }

        # Close the connection
        mysqli_close( $dbc ) ;


        ?>
    </form>
</div>
</body>
</html>