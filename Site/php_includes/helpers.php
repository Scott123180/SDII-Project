<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script src="../js/helpers.js"></script>
</head>
<body></body>

<?php
#get this for use in functions below
require ' miscData.php ' ;
#Authors: Scott Hansen and Nicholas Burd
#Title: helpers.php
#Description: contains the back-end functions for the limbo db application

#shows errors in queries; set to false for final product
$debug = true;


#show lost short links on lost.php
function show_link_records_lost($dbc, $category, $time, $location) {
	#need to sterilize inputs
		#inCategory()
		#inTime()
		#inLocation()

	#modify default and unspecified arguments from the user input in lost.php
	#no category specified
	if ($category === 'item category' || $category === 'other') {
		#unset category argument
		$category = NULL;
	}
	#no time specified
	if ($time === 'time lost' || $time === 'don\'t know') {
		#unset time argument
		$time = NULL;
	}
	#no location specified
	if ($location === 'location' || $location === 'don\'t know') {
		#unset location argument
		$location = NULL;
	}



	/*
	 * =======================================
	 * Query Building Section
	 * =======================================
	 */

	# Create a base query
	$query = 'SELECT id, item_name, status, item_category FROM item, locations WHERE status = \'found\' ' ;

	#category not null
	if (isset($category)) {
		#add to query
		$query = $query . 'AND item_category = ' . $category . ' ' ;
	}

	#time not null; compare item age
	if (isset($time)) {
		#Convert the user shorthand to DATETIME
		$myDate = selectToMySQL($time) ;

		#build query based on each option
		#today
		if($myDate[0] === 'today') {
			$query = $query . 'AND item.create_date = ' . $myDate[1] . ' ' ;
		}
		#yesterday
		elseif($myDate[0] === 'yesterday') {
			$query = $query . 'AND item.create_date = ' . $myDate[1] . ' ' ;
		}
		#2 to 7 days
		elseif($myDate[0] === '2 to 7 days') {
			$query = $query . 'AND item.create_date BETWEEN ' . $myDate[1] . ' AND ' . $myDate[2] . ' ' ;
		}
		#longer than a week
		elseif($myDate[0] === 'longer than a week') {
			$query = $query . 'AND item.create_date > ' . $myDate[1] . ' ' ;
		}
	}
	#location not null
	if (isset($location)) {
		$query = $query . 'AND item.location_id = location.id ' ; #link locations and item
		$query = $query . 'AND location.name = ' . $location . ' ' ;
	}

	#add final semicolon to query
	$query = $query . ';' ;

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

#show all the details from the selected record
function show_record($dbc, $id) {
	# Create a query to get the name and price sorted by price

	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE id=' . $id . ';' ;


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

#show found short links on found.php
function show_link_records_found($dbc) {
	# Create a query to get the name and price sorted by price
	$query= 'SELECT id, item_name, status, item_category FROM Item WHERE status LIKE \'lost\';' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
		# rendering the table start.
		echo '<H1>Lost Items</H1>' ;
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
			$alink = '<A HREF=found.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
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

/*
 * build the javascript array needed in makeOptions()
 */
function makeJSArrays() {
	for($i = 0; $i < $campusLocations); i++) {
		return ;
	}
}


/*
 * ==================================
 * Convert vernacular search query to DATETIME
 */
#how long ago -> php date -> MySQL datetime comparison
function selectToMySQL($timeAgo) {
	#get the current time in PHP format
	if ($timeAgo === 'today') {
		#convert current time into SQL date
		$theDate = date( 'Y-m-d H:i:s') ;

		return $returnDate ;
	}
	elseif ($timeAgo === 'yesterday') {
		$phpDate = (time() + strtotime("-1 day")) ; #subtract 1 day from current time
		$theDate = date( 'Y-m-d H:i:s', $phpDate) ; #convert to MySQL date
		$returnDate = array('yesterday', $theDate); #put it in an array for query building
		return $returnDate ;
	}
	elseif ($timeAgo === '2 to 7 days') {
		$phpDate = (time() + strtotime("-2 days")); #subtract 2 days from current time
		$mySQLDate1 = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date

		$phpDate = (time() + strtotime("-7 days")); #subtract 7 days from current time
		$mySQLDate2 = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date
		#return range of dates
		$returnDate = array('2 to 7 days',$mySQLDate1, $mySQLDate2); #put in an array for query building
		return $returnDate ;
	}
	elseif ($timeAgo === 'longer than a week') {
		#subtract 8 days and convert to SQL date
		$phpDate = (time() + strtotime("-8 days")); #subtract 8 days
		$theDate = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date
		$returnDate = array('longer than a week', $theDate); #put in an array for query building
		return $returnDate;

	}
}
/*
 * ================================================
 * Valid input/error functions
 * ================================================
 */
#NEED TO EDIT
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

#NEED TO EDIT
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
</html>


