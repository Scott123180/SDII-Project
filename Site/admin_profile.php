<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Welcome to Limbo</title>
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
	<div class="container">
		<?php
			require( 'php_includes/helpers.php' ) ;
			require( 'php_includes/connect_db.php' ) ;
			global $dbc;
			
			$id = $_GET['id'];
			
			
			# Make the query
			$query = "SELECT username, first_name, last_name, superadmin FROM admin WHERE username='" . $id . "'";
			#show_query($query) ;

			# Execute the query
			$result = mysqli_query( $dbc, $query ) ;
			
			while ($row = mysqli_fetch_assoc($result)) {
				echo $row['username'];
				echo '<br>';
				echo $row['first_name'];
				echo '<br>';
				echo $row['last_name'];
				echo '<br>';
				echo $row['superadmin'];
				echo '<br>';
			}
			
			
			#echo username under Username:
			#echo first_name under First name:
			#echo last_name under Last name:
			#if superadmin= yes, echo "Superadmin" under Title:
			#if superadmin= no, echo "admin" under Title:
			
		?>
        <h1>Profile:</h1>
		<h3>Username:</h3>
        <h3>First Name:</h3>
		<h3>Last Name:</h3>
        <h3>Title:</h3>
    </div>
	
    <!--Button Container-->
    <div class="container">
        <!--Row 1-->
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Change Password</button>
            </div>
        </div>
</body>
</html>