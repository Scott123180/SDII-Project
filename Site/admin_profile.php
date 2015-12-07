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
			
			session_start( );
			if (!isset($_SESSION["username"])){
				header("location: admin_logon.php");
			}
			
			
			
			# Make the query
			$query = "SELECT username, first_name, last_name, superadmin FROM admin WHERE username='" . $_SESSION['username'] . "'";
			#show_query($query) ;

			# Execute the query
			$result = mysqli_query( $dbc, $query ) ;
			
			while ($row = mysqli_fetch_assoc($result)) {
				$username=$row['username'];
				$firstname=$row['first_name'];
				$lastname=$row['last_name'];
				$superadmin=$row['superadmin'];
			}
			
			if($superadmin="yes"){
				$title="Superadmin";
			}
			else{
				$title="Admin";
			}
			
			
		?>
        <h1 align="center">Profile</h1>
		<table align="center">
				<tr>
				<td><h3>Username:</h3></td><td><?php echo $username; ?></td>
				</tr>
				<tr>
				<td><h3>First Name:</h3></td><td><?php echo $firstname; ?></td>
				</tr>
				<tr>
				<td><h3>Last Name:</h3></td><td><?php echo $lastname; ?></td>
				</tr>
				<tr>
				<td><h3>Title:</h3></td><td><?php echo $title; ?></td>
				</tr>
			</table>
    </div>
	
    <!--Button Container-->
    <div class="container">
        <!--Row 1-->
        <div class="row">
            <div class="col-md-6">
                <a href="admin_change_password.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Change Password</button>
            </div>
			<div class="col-md-6">
                <a href="admin_change_username.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Change Username</button>
            </div>
        </div>
		<!--Row 1-->
        <div class="row">
            <div class="col-md-6">
                <a href="admin_change_firstname.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Change First Name</button>
            </div>
			<div class="col-md-6">
                <a href="admin_change_lastname.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Change Last Name</button>
            </div>
        </div>
		<br>
		<div class="row" align="center">
			<a href="logout.php">Logout</a>
		</div>
</body>
</html>