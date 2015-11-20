<!--
=========================================================
Unable to solve during office hours, problem is on line 77 linkypresidents and SQL query
=========================================================
-->

<?php
$debug = true;

#Scott Hansen and Nicholas Burd

# Shows the records in prints
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT item_name, item_status, item_category FROM Item WHERE item_category='found';' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Lost Items</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>Item Name</TH>';
  		echo '<TH>Item Status</TH>';
  		echo '<TH>Item Category</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['item_name'] . '</TD>' ;
    		echo '<TD>' . $row['item_status'] . '</TD>' ;
    		echo '<TD>' . $row['item_category'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_link_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT num, lname FROM presidents ;' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Presidents</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>Number</TH>';
  		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			$alink = '<A HREF=linkypresidents.php?num=' . $row['num'] . '>' . $row['num'] . '</A>' ;
    		echo '<TR>' ;
    		echo '<TD ALIGN=right>'. $alink . '</TD>' ;
    		echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_record($dbc, $num) {
	# Create a query to get the name and price sorted by price
	
	
	$query = 'SELECT num, fname, lname FROM presidents WHERE num=' . $num . ';' ;


	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Presidents</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>Number</TH>';
  		echo '<TH>First Name</TH>';
  		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['num'] . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
    		echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

# Inserts a record into the prints table
function insert_record($dbc, $num, $fname,$lname) {
  $query = 'INSERT INTO presidents(num, fname,lname) VALUES ("' . $num . '" , "' . $fname . '" , "' . $lname . '" )' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function valid_number($num) {
 if(empty($num) || !is_numeric($num))
 return false ;
 else {
 $num = intval($num) ;
 if($num <= 0)
 return false ;
 }
 return true ;
}

function valid_name($name) {
	if (empty($name)) {
		return false;
	} else {return true;}
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

#prints a javascript console message for debugging
function js_console_debug($message) {
	if ($message != '') {
		echo '<script type="text/javascript">console.log("' . $message . '")</script>' ;
		return;
	} else {
		echo '<script type="text/javascript">console.log("failed to debug")</script>' ;
		return;
	}
}
?>