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
            <div class="span4"><a href="index.html"><img class="img-responsive center-block" src="images/limbocompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
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

    </div class="container">

        <?php
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
        show_link_records($dbc);

        # Close the connection
        mysqli_close( $dbc ) ;
        ?>
    <!-- Get inputs from the user. -->
    <form action="linkypresidents.php" method="POST">
        <table>
            <tr>
                <td>President Number:</td><td><input type="text" name="num" value="<?php if (isset($_POST['num'])) echo $_POST['num']; ?>"></td>
            </tr>
            <tr>
                <td>First Name:</td><td><input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></td>
            </tr>
            <tr>
                <td>Last Name:</td><td><input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></td>
            </tr>
        </table>
        <p><input type="submit" ></p>
    </form>


    </div>
	<div class="container-fluid">

        <div class="row">
			<div class="col-md-4" style="background-color:#cc0000; text-align:center"></div>
			
            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Submit New Lost Item</button>
            </div>
        </div>
    </div>
</body>
</html>