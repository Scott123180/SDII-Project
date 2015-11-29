<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
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
        <!--item category, how long ago lost, where lost-->
        <h4>Item Category</h4>
        <select class="form-control" id="itemCategory"></select>
        <script>makeOptions(itemCategories, "itemCategory");</script>

        <h4>How long ago was it lost?</h4>
        <select class="form-control" id="timeLost"></select>
        <script>makeOptions(timeRanges, "timeLost")</script>

        <h4>What building did you lose it in?</h4>
        <select class="form-control" id="campusLocations"></select>
        <script>makeOptions(campusLocations, "campusLocations")</script>

        <button type="button" class="btn btn-primary btn-lg" onclick="" style="margin-top:15px;">submit</button>

    </div>
    <!--tables-->
    <div class="container">
        <?php
        
        # Connect to MySQL server and the database
        require( 'php_includes/connect_db.php' ) ;

        # Includes these helper functions
        require( 'php_includes/helpers.php' ) ;


        #get link num and show specific record
        if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
            if(isset($_GET['id']))
                show_record($dbc, $_GET['id']) ;
        }

        # Show the records
        show_link_records_lost($dbc);

        # Close the connection
        mysqli_close( $dbc ) ;
        
        ?>
        <button type="button" class="btn btn-primary btn-lg" onclick="grabLostData()" style="margin-bottom:15px">Continue Submitting New Lost Item</button>
    </div>
</body>
</html>