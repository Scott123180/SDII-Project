﻿<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Please Login</title>
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

    <div class="container">
        <h1>Hey Admin! Please login below.</h1>
		<?php
			# Connect to MySQL server and the database
			require( 'php_includes/connect_db.php' ) ;

			# Connect to MySQL server and the database
			require( 'php_includes/limbo_login_tools.php' ) ;

			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

				$username = $_POST['username'] ;
				$password = $_POST['password'] ;
				
				$check=validate($username, $password);
				if($check==true){
					load('admin_landing.php', $username);
				}
				else{
					echo 'Login Failed';
				}

				#if($pid == -1)
				#	echo '<P style=color:red>Login failed please try again.</P>' ;

				#else
				
			}
		?>
		<!-- Get inputs from the user. -->
		<form action="admin_logon.php" method="POST">
			<table>
				<tr>
					<td>Username:</td><td><input type="text" name="username"></td>
					<td>Password:</td><td><input type="text" name="password"></td>
				</tr>
			</table>
			<p><input type="submit" ></p>
		</form>
    </div>
</body>
</html>