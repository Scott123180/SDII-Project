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
        <h1>Change Password Below.</h1>
		<?php
			require( 'php_includes/connect_db.php' ) ;
			global $dbc;
			
			session_start( );
			if (!isset($_SESSION["username"])){
				header("location: admin_logon.php");
			}
			
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				
				$username= $_POST['username'];
				$oldpassword = $_POST['oldpassword'] ;
				$newpassword = $_POST['newpassword'] ;
				
				changePassword($newpassword, $oldpassword, $username);
			}
			function changePassword($newpassword,$oldpassword,$username){
				global $dbc;
				
				#checks if username and password are found in query
				$query = "SELECT username, password FROM admin WHERE username='" . $username . "' AND password='" . $oldpassword . "'";
				$results = mysqli_query( $dbc, $query ) ;
				
				if (mysqli_num_rows( $results ) == 0 ){
					echo 'Change Failed';
					
				}else{
					$query2="UPDATE admin SET password='" . $newpassword . "' WHERE username='" . $username . "'";
				
					$results2 = mysqli_query( $dbc, $query ) ;
					echo 'Change Successful';
				}
			}
			
		?>
		<!-- Get inputs from the user. -->
		<form action="admin_change_password.php" method="POST">
			<table>
				<tr>
					<td>Username:</td><td><input type="text" name="username"></td>
					<td>Old Password:</td><td><input type="password" class="form-control" name="oldpassword" placeholder="Old Password"></td>
					<td>New Password:</td><td><input type="password" class="form-control" name="newpassword" placeholder="New Password"></td>
				</tr>
			</table>
			<p><input type="submit" ></p>
		</form>
    </div>
	<div class="row" align="center">
		<a href="logout.php">Logout</a>
	</div>
</body>
</html>