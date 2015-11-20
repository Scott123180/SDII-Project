<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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

    <div class="container-fluid">

        <!--Header-->
        <div class="row">
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php"><h4>Lost Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php"><h4>About</h4></a></div>
        </div>
    </div>


<!--
        <?php
        /*
        # Connect to MySQL server and the database
        require( 'php_includes/connect_db.php' ) ;

        # Includes these helper functions
        require( 'php_includes/helpers.php' ) ;

        # Check form submitted.

        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ){

        # Initialize an error array.

            $errors = array();


        # Check for a number & first name & last name.

        #num
            if ( empty( $_POST[ 'num' ]) )   {
                $errors[] = 'num' ; }

            else { $num = trim( $_POST[ 'num' ] )  ; }

        #first name
            if ( empty( $_POST[ 'fname' ]) )   {
                $errors[] = 'fname' ; }

            else { $fname = trim( $_POST[ 'fname' ] )  ; }

        #last name
            if ( empty( $_POST[ 'lname' ] ) )  {
                $errors[] = 'lname' ; }

            else { $lname = trim( $_POST[ 'lname' ] )  ; }


        # Report result.

            if( !empty( $errors ) )
            {

                echo 'Error! Please enter your  ' ;

                foreach ( $errors as $msg ) { echo " - $msg " ; }
            }

            else {
                $result = insert_record($dbc, $num, $fname, $lname) ;
                echo "Success! Thanks $fname " ; }
        }

        #get link num and show specific record
        else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
            if(isset($_GET['num']))
                show_record($dbc, $_GET['num']) ;
        }

        # Show the records
        show_records($dbc);

        # Close the connection
        mysqli_close( $dbc ) ;
        */
        ?>
-->
    <!--Temporary data-->
    </div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date/time</th>
            <th>Status</th>
            <th>Stuff</th>
        </tr>
        </thead>
        <!--NPHP: Need to code in PHP to make table-->
        <tbody>
        <tr>
            <td>11/10/15</td>
            <td>Lost</td>
            <td><a href="#" style="color:red">Iphone 6s</a></td>
        </tr>
        <tr>
            <td>11/15/15</td>
            <td>Lost</td>
            <td><a href="#" style="color:red">Head tennis racket</a></td>
        </tr>
        <tr>
            <td>11/15/15</td>
            <td>Found</td>
            <td><a href="#" style="color:red">Granola Bar</a></td>
        </tr>
        </tbody>
    </table>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Ticket Num</th>
            <th>Item Name</th>
            <th>Location Found</th>
            <th>Date Reported</th>
            <th>Date Updated</th>
            <th>Date Lost</th>
            <th>Description</th>
            <th>Room</th>
            <th>Status</th>
            <th>Make</th>
            <th>Model</th>
            <th>Color</th>
            <th>Reward</th>
        </tr>
        </thead>
        <tr>
            <td>1</td>
            <td>Iphone 6s</td>
            <td>Hancock</td>
            <td>11/10/15</td>
            <td>11/10/15</td>
            <td>11/9/15</td>
            <td>It has a large scratch on the screen</td>
            <td></td>
            <td>Lost</td>
            <td>Iphone</td>
            <td>6s</td>
            <td>Rose Gold</td>
            <td>$10</td>
        </tr>
    </table>




    <!-- Get inputs from the user. -->
    <form action="lost.php" method="POST">
        <table>
            <tr>
                <td>Item Name :</td><td><input type="text" name="num" value="<?php if (isset($_POST['num'])) echo $_POST['num']; ?>"></td>
            </tr>
            <tr>
                <td>Where Lost:</td><td><input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></td>
            </tr>
            <tr>
                <td>When Lost:</td><td><input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></td>
            </tr>
        </table>
        <!--<p><input type="submit" ></p> -->
    </form>


    </div>
	<div class="container-fluid">

        <div class="row">
			<div class="col-md-4" style="background-color:#cc0000; text-align:center"></div>
			
            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Coninue Submiting New Lost Item</button>
            </div>
        </div>
    </div>
</body>
</html>