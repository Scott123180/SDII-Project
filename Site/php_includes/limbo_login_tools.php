<!--
This file contains PHP login helper functions.
Orginally created by Ron Coleman.
===================================================
Modified by Nicholas Burd and Scott Hansen
===================================================
History:
Who	Date		Comment
RC	 7-Nov-13	Created.
-->
<?php
# Includes these helper functions
require( 'php_includes/helpers.php' ) ;

# Loads a specified or default URL.
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
	
	header( "Location: $url" ) ;

	#exit() ;
}
function validate($username,$password)
{
    global $dbc;
	
	$superadmin;
    # Make the query
    $query = "SELECT username, password, superadmin FROM admin WHERE username='" . $username . "' AND password='" . $password . "'" ;
    #show_query($query) ;
	
	
    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;
	
	$row = mysqli_fetch_assoc($results);
	$superadmin=$row['superadmin'];
	
	#checks if username and password are found in query
	if (mysqli_num_rows( $results ) == 0 ){
		echo "Login Failed";
	}else{
		if($superadmin='yes'){
			loadSuperadmin('superadmin_landing.php', $username);
		}else if($superadmin='no'){
			load('admin_landing.php', $username);
		}
	}
}
?>