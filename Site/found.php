<?php session_start() #start a new session
?>
<!DOCTYPE html>
<!--
Authors: Scott Hansen and Nicholas Burd
Title: found.php
Description: page for user to look to see if another user has submitted
a lost claim for an item. If item isn't submitted as lost, finder
can add the item to the database.
-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/helpers.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/helpers.js"></script>

    <title>Found Something</title>
</head>
<body>
    <div class="container-fluid" style="background-color:#aaaaaa">
        <div class="row">
            <div class="span4"></div>
            <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/LimboCompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
            <div class="span4"></div>
        </div>
    </div>

    <div class="container-fluid">

        <!--Header-->
        <div class="row">
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php" style="color:white;"><h4>Lost Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php" style="color:white;"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php" style="color:white;"><h4>About</h4></a></div>
        </div>
    </div>

    <!--select options-->
    <div class="container">
        <form id="lostOptions" method="post" action="found.php">
            <h4>Item Category</h4>
            <select class="form-control" name="iCat" id="iCat">
                <option>item category</option>
                <script>makeOptions(itemCategories, "iCat");</script>
            </select>

            <h4>What location did you lose it at?</h4>
            <select class="form-control" name="campLoc" id="campLoc">
                <option>location</option>
                <script>makeOptions(campusLocations, "campLoc")</script>
                <option>unknown</option>
            </select>

            <input type="submit" class="form-control" name = 'submitFilter' value="Submit" style="margin-top: 15px" />
        </form>
        <br/>
    </div>

    <!-- tables -->
    <div class="container">
	<?php
        
    # Connect to MySQL server and the database
    require( '../connect_db.php' ) ;

    # Includes these helper functions
    require( 'php_includes/helpers.php' ) ;

    $currentID = 0;
    #if GET id in GET request, show the record of that item
    if(isset($_GET['id'])) {
        $currentID = $_GET['id'];
        echo $currentID;
        #save the id in session for the next page
        $_SESSION['itemClaimNumber'] = $currentID;
        echo $currentID;
        show_record($dbc, $currentID, 'found') ;
    }

    #filter results
    if(isset($_POST['submitFilter'])) {
        #if the filter submit button was clicked
        $category = $_POST['iCat'];
        $location = $_POST['campLoc'];
        show_link_records_found($dbc, $category, $location) ;
    }

    # Close the connection
    mysqli_close( $dbc ) ;
        
    ?>

        <button type="button" class="btn btn-primary btn-lg" name="submitFoundItem" onclick="window.location='create_found_item.php'" style="margin-bottom:15px">Submit New Found Item</button>
    </div>


</body>
</html>