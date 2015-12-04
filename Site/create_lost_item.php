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
        <form class="form-group" method="post">
            <h4>What location did you lose it at?</h4>
            <select class="form-control" name="campLoc" id="campLoc">
                <option>location</option>
                <script>makeOptions(campusLocations, "campLoc")</script>
                <option>unknown</option>
            </select>

            <h4>What room did you lose it in?</h4>
            <input type="text" class="form-control" placeholder="example: 303, 202, et cetera" name="room">

            <h4>When did you lose it?</h4>
            <input type="date" class="form-control" name="date_lost">

            <h4>What is name of the item?</h4>
            <input type="text" class="form-control" placeholder="example: scarf, bologna, laptop" name="name">

            <h4>Please describe the item:</h4>
            <textarea class="form-control" rows="3" placeholder="description" name="description"></textarea>

            <h4>Item Category</h4>
            <select class="form-control" name="iCat" id="iCat">
                <option>item category</option>
                <script>makeOptions(itemCategories, "iCat");</script>
            </select>

            <h4>What is the item's make?</h4>
            <input type="text" class="form-control" placeholder="example: apple, microsoft, nordstrom, et. cetera" name="make">

            <h4>What is the item's model?</h4>
            <input type="text" class="form-control" placeholder="example: 6s, Lumia 920, et. cetera" name="model">

            <h4>What is the item's color?</h4>
            <input type="text" class="form-control" placeholder="item color" name="color">

            <h4>Do you wish to offer a reward for the item?</h4>
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group" style="margin-bottom: 15px; max-width: 200px">
                <div class="input-group-addon">$</div>
                <input type="text" class="form-control" id="reward" name="reward" placeholder="max: $100">
                <div class="input-group-addon">.00</div>
            </div>

            <div class="g-recaptcha" data-sitekey="your_site_key"></div>
                <br/>
            <input type="submit" class="form-control" name = "submitItem" value="Submit" style="margin-top: 15px;margin-bottom: 15px" />


            <?php
            # Connect to MySQL server and the database
            require( 'php_includes/connect_db.php' ) ;

            # Includes these helper functions
            require( 'php_includes/helpers.php' ) ;

            require( 'php_includes/form_validation.php' );


            # get all the inputted data
            if(isset($_POST['submitItem'])) {

                #only set variables if they are not null
                $location = $_POST['campLoc'];
                $room = $_POST['room'];
                $dateLost = $_POST['date_lost'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $category = $_POST['iCat'];
                $make = $_POST['make'];
                $model = $_POST['model'];
                $color = $_POST['color'];
                $reward = $_POST['reward'];
                $status = 'lost' ;



                if(isset($_POST['campLoc'])){$location = $_POST['campLoc'];}
                if(isset($_POST['room'])){$room = $_POST['room'];}
                if(isset($_POST['date_lost'])){$dateLost = $_POST['date_lost'];}
                if(isset($_POST['name'])){$name = $_POST['name'];}
                if(isset($_POST['description'])){$description = $_POST['description'];}
                if(isset($_POST['iCat'])){$category = $_POST['iCat'];}
                if(isset($_POST['make'])){$make = $_POST['make'];}
                if(isset($_POST['model'])){$model = $_POST['model'];}
                if(isset($_POST['color'])){$color = $_POST['color'];}
                if(isset($_POST['reward'])){$reward = $_POST['reward'];}


                #get error array
                $errors = validateCreateLost($location, $room, $dateLost, $name, $description, $category, $color, $reward);
                #if there are no errors
                if(empty($errors)){
                    #location_id, item_lost_date, item_name, item_description, room, status, item_category, make, model, color, reward
                    insert_record($location, $dateLost, $name, $description, $room, $status, $category, $make, $model, $color, $reward);
                }
                #print errors for user to see
                else {
                    $errorStatement = 'Please fix errors in these fields: ' ;
                    for($x = 0; $x < count($errorStatement) ; $x++){
                        $errorStatement .= $errors[$x] . ', ';
                    }
                    echo "<p>" . $errorStatement . "</p>";
                }
            }

            # Close the connection
            mysqli_close( $dbc ) ;

            ?>
        </form>
    </div>
</body>
</html>