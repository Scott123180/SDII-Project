<!DOCTYPE html>
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
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php" style="color:white;"><h4>Lost Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php" style="color:white;"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php" style="color:white;"><h4>About</h4></a></div>
        </div>
    </div>

    <div class="container">
        <h1>Hey Admin! Please login below.</h1>
		<?php
			# Connect to MySQL server and the database
			require( '../connect_db.php' ) ;
			require('php_includes/password_validation.php');
			
			# Connect to MySQL server and the database
			#require( 'php_includes/limbo_login_tools.php' ) ;

			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

				#get username and password from user
				$username = $_POST['username'] ;
				$password = $_POST['password'] ;
				
				#attempt to validate the user's information and login
				validatePassword($username,$password);
				#validate($username, $password);
				
			}
		?>
		<!-- Get inputs from the user. -->
		<form action="admin_logon.php" method="POST" class="form">
			<table>
				<tr>
					<td>Username:</td><td><input type="text" class="form-control" name="username"></td>
					<td>Password:</td><td><input type="password" class="form-control" name="password" placeholder="password"></td>
				</tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-default">
                    </td>
                </tr>
			</table>
		</form>
    </div>
</body>
</html>