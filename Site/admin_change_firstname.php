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
        <h1>Change First Name Below.</h1>
		<?php
			require( '../connect_db.php' ) ;
			require ( 'php_includes/hash.php' ) ;
			require ( 'php_includes/form_validation.php ' ) ;
			global $dbc;
			
			
			
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				
				$username= $_POST['username'];
				$newusername = $_POST['newfirstname'] ;
				$password = $_POST['password'] ;
				
				if(validateString($password,strlen($password))==true){
					#2. run input through hash
					$query = "SELECT salt, password FROM admin WHERE username='" . $username . "'";
					#show_query($query) ;
					$result = mysqli_query( $dbc, $query ) ;
					$row = mysqli_fetch_assoc($result);
					$salt=$row['salt'];
					$pass=$row['password'];
					
					#3. compare hash to password
					#4. return true or false
					
					$hashedpass=hashPassword($password,$salt);
					
					if($hashedpass==$pass){
						#password validated
						
						$query2="UPDATE admin SET first_name='" . $newfirstname . "' WHERE username='" . $username . "'";
						
						$results2 = mysqli_query( $dbc, $query2 ) ;
						echo 'Change Successful';
						
					}else{
						#validation failed
						echo 'Change Failed';
					}
					
					
					#5. close sql connection
				}
				
				
			}
			
		?>
		<!-- Get inputs from the user. -->
		<form action="admin_change_firstname.php" method="POST">
			<table>
				<tr>
					<td>Username:</td><td><input type="text" class="form-control" name="username"></td>
					<td>New First Name:</td><td><input type="text" class="form-control" name="newfirstname"></td>
					<td>Password:</td><td><input type="password" class="form-control" name="password" placeholder="Password"></td>
				</tr>
                <tr>
                    <td><input type="submit" class="btn btn-default"></td>
                </tr>
			</table>

		</form>
    </div>
	<div class="container">
	<!--Row 2-->
        <div class="row">
            <div class="col-md-6">
				<a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Logout</button>
            </div>
			<div class="col-md-6">
				<a href="admin_profile.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Admin Profile</button>
            </div>
        </div>
	</div>
</body>
</html>