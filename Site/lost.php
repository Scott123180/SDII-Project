<!DOCTYPE html>
<!--
Authors: Scott Hansen and Nicholas Burd
Title: lost.php
Description: page for if one has lost an item and wants to check
if it has been found. If it hasn't, the user can add an entry to the database
-->

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/helpers.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Lost Something</title>
</head>
<body>
    <div class="container-fluid" style="background-color:#aaaaaa">
        <div class="row">
            <div class="span4"></div>
            <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/LimboCompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
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

    <!--select options-->
    <div class="container">
        <form id="lostOptions" method="post" action="lost.php">
            <h4>Item Category</h4>
            <select class="form-control" name="iCat" id="iCat">
                <option>item category</option>
                <script>makeOptions(itemCategories, "iCat");</script>
            </select>

            <h4>How long ago was it lost?</h4>
            <select class="form-control" name="tLost" id="tLost">
                <option>time lost</option>
                <script>makeOptions(timeRanges, "tLost")</script>
                <option>unknown</option>
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

    <!--tables-->
    <div class="container">
        <?php
        # Connect to MySQL server and the database
        require( 'php_includes/connect_db.php' ) ;

        # Includes these helper functions
        require( 'php_includes/helpers.php' ) ;

        #if GET id in GET request, show the record of that item
        if(isset($_GET['id'])) {
            show_record($dbc, $_GET['id'], 'lost') ; }

        if(isset($_POST['submitFilter'])) {
            #if the filter submit button was clicked
            $category = $_POST['iCat'];
            $time = $_POST['tLost'];
            $location = $_POST['campLoc'];
            show_link_records_lost($dbc, $category, $time, $location) ;
        }

        # Close the connection
        mysqli_close( $dbc ) ;
        
        ?>
        <button type="button" class="btn btn-primary btn-lg" onclick="grabLostData()" style="margin-bottom:15px">Continue Submitting New Lost Item</button>
    </div>
</body>
</html>