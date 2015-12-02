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
function load( $page = 'SDII-Project/Site/admin_landing.php', $username)
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL and the print id.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page . '?id=' . $username;

  # Execute redirect then quit.
  session_start( );

  header( "Location: $url" ) ;

  exit() ;
}

function validate($username,$password)
{
    global $dbc;

    # Make the query
    $query = "SELECT username password FROM admin WHERE username='" . $username . "' AND password='" . $password . "'" ;
    show_query($query) ;

    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;
	
	#checks if username and password are found in query
	if (mysqli_num_rows( $results ) == 0 ){
		return false;
	}else{
		return true;
	}
}
?>