<?php
#Password validation tools
#Authors: Scott Hansen and Nicholas Burd
require ( 'hash.php' ) ;
require ( 'form_validation.php ' ) ;
require ( '../connect_db.php' ) ;

function validatePassword($username,$password) {
    global $dbc;
	
	
    #1. sterilize input
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
		#echo hashPassword($password,$salt);
		$hashedpass=hashPassword($password,$salt);
		
		if($hashedpass==$pass){
			#password validated
			
			$query = "SELECT superadmin FROM admin WHERE username='" . $username . "' AND password='" . $pass . "'" ;
	
			# Execute the query
			$results = mysqli_query( $dbc, $query ) ;
	
			$row = mysqli_fetch_assoc($results);
			$superadmin=$row['superadmin'];
			if($superadmin=="yes"){
				loadSuperadmin('superadmin_landing.php', $username);
			}else if($superadmin=="no"){
				load('admin_landing.php', $username);
			}
		}else{
			#validation failed
			echo "Login Failed";
		}
		
		
		#5. close sql connection
	}
}

function load( $page="../admin_landing.php", $username)
{
	# Begin URL with protocol, domain, and current directory.
	$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

	# Remove trailing slashes then append page name to URL and the print id.
	$url = rtrim( $url, '/\\' ) ;
	$url .= '/' . $page . '?id=' . $username;

	# Execute redirect then quit.
	session_start( );
	
	$_SESSION['username']=$username;
	$_SESSION['superadmin']='no';
	
	header( "Location: $url" ) ;

	#exit() ;
}
function loadSuperadmin( $page="../superadmin_landing.php", $username)
{
	# Begin URL with protocol, domain, and current directory.
	$url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

	# Remove trailing slashes then append page name to URL and the print id.
	$url = rtrim( $url, '/\\' ) ;
	$url .= '/' . $page . '?id=' . $username;

	# Execute redirect then quit.
	session_start( );
	
	$_SESSION['username']=$username;
	$_SESSION['superadmin']='yes';
	
	header( "Location: $url" ) ;

	#exit() ;
}

?>