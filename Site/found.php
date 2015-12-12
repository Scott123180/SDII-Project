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

	<?php
        
        # Connect to MySQL server and the database
        require( '../connect_db.php' ) ;

        # Includes these helper functions
        require( 'php_includes/helpers.php' ) ;



        #get link num and show specific record
        if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
            if(isset($_GET['id']))
                show_record($dbc, $_GET['id']) ;
        }

        # Show the records
        show_link_records_found($dbc);

        # Close the connection
        mysqli_close( $dbc ) ;
        
        ?>

	<div class="container">

        <div class="row">
			<div class="col-md-4" style="background-color:#cc0000; text-align:center"></div>
			
            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-lg btn-block" onClick="grabFoundData()" style="margin-bottom:15px">Continue Submitting New Found Item</button>

            </div>
        </div>
    </div>

</body>
</html>