
<?php
#shows errors in queries; disable for final product
$debug = true;

#Scott Hansen and Nicholas Burd


#show lost short links on lost.php
function show_link_records_lost($dbc) {
	# Create a query to get the name and price sorted by price
	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE status=\'found\';' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Found Items</H1>' ;
  		echo '<table class="table table-striped">';
  		echo '<TR>';
  		echo '<TH>Item ID</TH>';
  		echo '<TH>Item Name</TH>';
		echo '<TH>Item Status</TH>';
		echo '<TH>Item Category</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			$alink = '<A HREF=lost.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
    		echo '<TR>' ;
    		echo '<TD>'. $alink . '</TD>' ;
    		echo '<TD>' . $row['item_name'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['item_category'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_record($dbc, $id) {
	# Create a query to get the name and price sorted by price
	
	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE status=\'found\' AND id=' . $id . ';' ;


	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Found Items</H1>' ;
  		echo '<table class ="table table-striped">';
  		echo '<TR>';
  		echo '<TH>Item ID</TH>';
  		echo '<TH>Item Name</TH>';
  		echo '<TH>Item Status</TH>';
		echo '<TH>Item Category</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['id'] . '</TD>' ;
    		echo '<TD>' . $row['item_name'] . '</TD>' ;
    		echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['item_category'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

# Inserts a record into the prints table
function insert_record($dbc, $location_id, $item_lost_date ,$item_name, $item_description, $room, $status, $item_category, $make, $model, $color, $reward) {
  $query = 'INSERT INTO Item(location_id, item_lost_date, item_name, item_description, room, status, item_category, make, model, color, reward) 
			VALUES ("' . $location_id . '" , "' . $item_lost_date . '" , "' . $item_name . '", "' . $item_description . '", "' . $room . '", "' . $status . '", "' . $item_category . '", "' . $make . '", "' . $model . '", "' . $color . '", "' . $reward . '")' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}




#These functions are used for found.php
function show_link_records_found($dbc) {
	# Create a query to get the name and price sorted by price
	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE status=\'lost\';' ;

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
  		echo '<TH>Item ID</TH>';
  		echo '<TH>Item Name</TH>';
		echo '<TH>Item Status</TH>';
		echo '<TH>Item Category</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			$alink = '<A HREF=found.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
    		echo '<TR>' ;
    		echo '<TD ALIGN=right>'. $alink . '</TD>' ;
    		echo '<TD>' . $row['item_name'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['item_Category'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_record2($dbc, $id) {
	# Create a query to get the name and price sorted by price
	
	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE status=\'lost\' AND id=' . $id . ';' ;


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
  		echo '<TH>Item ID</TH>';
  		echo '<TH>Item Name</TH>';
  		echo '<TH>Item Status</TH>';
		echo '<TH>Item Category</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['id'] . '</TD>' ;
    		echo '<TD>' . $row['item_name'] . '</TD>' ;
    		echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['item_category'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

# Inserts a record into the prints table
function insert_record2($dbc, $location_id, $item_name, $item_description, $room, $status, $item_category, $make, $model, $color) {
  $query = 'INSERT INTO Item(location_id, item_lost_date, item_name, item_description, room, status, item_category, make, model, color, reward) 
			VALUES ("' . $location_id . '" , "' . $item_name . '", "' . $item_description . '", "' . $room . '", "' . $status . '", "' . $item_category . '", "' . $make . '", "' . $model . '", "' . $color . '")' ;
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
