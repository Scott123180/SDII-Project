﻿<!DOCTYPE html>
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
        <h1>Add Admin Below.</h1>
		<?php
			require( '../connect_db.php' ) ;
			require ( 'php_includes/hash.php' ) ;
			require ( 'php_includes/form_validation.php ' ) ;
			global $dbc;
			
			#start session in admin account user logged into
			session_start( );
			#go to login page if not logged in
			if (!isset($_SESSION["username"])){
				header("location: admin_logon.php");
			}
			
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				
				$username= $_POST['username'];
				$firstName = $_POST['firstName'] ;
				$lastName = $_POST['lastName'] ;
				$password = $_POST['password'] ;
				
				if(validateString($password,strlen($password))==true){
					
					$characters="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$mixedString=str_shuffle($characters);
					$salt=substr($mixedString,0,32);
					
					$hashPassword=hashPassword($password,$salt);
					
				}
				
				
				addAdmin($username,$firstName,$lastName,$salt,$hashPassword);
			}
			function addAdmin($username, $firstName, $lastName, $salt, $hashPassword){
				global $dbc;
				
				#ensures admin does not already exist
				$query = "SELECT username FROM admin WHERE username = '" . $username . "'";
				$results = mysqli_query( $dbc, $query ) ;
				
				if (mysqli_num_rows( $results ) != 0 ){
					echo 'Admin Add Failed';
					
				}else{
					$query2="INSERT INTO admin(username, first_name, last_name, salt, password)
							VALUES('" . $username . "','" . $firstName . "','" . $lastName . "','" . $salt . "','" . $hashPassword . "')";
				
					$results2 = mysqli_query( $dbc, $query2 ) ;
					echo 'Admin Added';
				}
			}
			
		?>
		<!-- Get inputs from the user. -->
		<form action="admin_add.php" method="POST">
			<table style="margin-left: auto; margin-right: auto">
				<tr>
					<td><p>Username:</p><input type="text" class="form-control" name="username"></td>
                    <td><p style="color: white">...</p></td>
					<td><p>First Name:</p><input type="text" class="form-control" name="firstName"> </td>
                </tr>
                <br/>
                <tr>
					<td><p>Last Name:</p><input type="text" class="form-control" name="lastName"></td>
                    <td><p style="color: white">...</p></td>
					<td><p>Password:</p><input type="password" class="form-control" name="password" placeholder="Password"></td>
				</tr>

			</table>
			<input type="submit" class="btn btn-default">
		</form>
    </div>
	<div class="container">
	<!--Row 2-->
        <div class="row">
            <div class="col-md-6">
				<a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Logout</button>
            </div>
			<div class="col-md-6">
				<a href="superadmin_landing.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Super Admin Page</button>
            </div>
        </div>
	</div>
</body>
</html>