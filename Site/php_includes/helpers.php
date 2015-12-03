<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script src="../js/helpers.js"></script>
</head>
<body></body>

<?php
#get this for use in functions below

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
	if ($category === 'item category') {
		#unset category argument
		unset($category);
	}
	#no time specified
	if ($time == 'time lost' || $time == 'unknown') {
		#unset time argument
		unset($time);
	}
	#no location specified
	if ($location === 'location' || $location === 'unknown') {
		#unset location argument
		unset($location);
	}

	/*
	 * =======================================
	 * Query Building Section
	 * =======================================
	 */

	# Create a base query
	$query = 'SELECT item.id, item.item_name, item.status, item.item_category FROM item WHERE item.status = \'found\' ' ;

    #this needs to be first isset check because more tables needed for location check
    #location not null
    if (isset($location)) {
        $query = 'SELECT item.id, item.item_name, item.status, item.item_category FROM item, locations WHERE item.status = \'found\' ' ;
        $query = $query . 'AND item.location_id = locations.id ' ; #link locations and item
        $query = $query . 'AND locations.name = \'' . $location . '\' ' ;
    }
	#category not null
	if (isset($category)) {
		#add to query
		$query = $query . 'AND item.item_category = \'' . $category . '\' ' ;
	}

	#time not null; compare item age
	if (isset($time)) {
		#Convert the user shorthand to DATETIME
		$myDate = selectToMySQL($time) ;

		#build query based on each option
		#today
		if($myDate[0] === 'today') {
			$query = $query . 'AND item.create_date = \'' . $myDate[1] . '\' ' ;
		}
		#yesterday
		elseif($myDate[0] === 'yesterday') {
			$query = $query . 'AND item.create_date = \'' . $myDate[1] . '\' ' ;
		}
		#2 to 7 days
		elseif($myDate[0] === '2 to 7 days') {
			$query = $query . 'AND item.create_date BETWEEN \'' . $myDate[1] . '\' AND \'' . $myDate[2] . '\' ' ;
		}
		#longer than a week
		elseif($myDate[0] === 'longer than a week') {
			$query = $query . 'AND item.create_date > \'' . $myDate[1] . '\' ' ;
		}
	}


	#add final semicolon to query
	$query = $query . ';' ;

    echo $query ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;


	# Show results
	if( $results ) {
        # But...wait until we know the query succeed before
        # rendering the table start.
        echo '<H1>Found Items</H1>';
        echo '<table class="table table-striped">';
        echo '<TR>';
        echo '<TH>Item ID</TH>';
        echo '<TH>Item Name</TH>';
        echo '<TH>Item Status</TH>';
        echo '<TH>Item Category</TH>';
        echo '</TR>';

        # For each row result, generate a table row
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $alink = "<A HREF=lost.php?id=" . $row['id'] . ">" . $row['id'] . "</A>";
            echo "<TR>";
            echo "<TD>" . $alink . "</TD>";
            echo "<TD>" . $row['item_name'] . "</TD>";
            echo "<TD>" . $row['status'] . "</TD>";
            echo "<TD>" . $row['item_category'] . "</TD>";
            echo "</TR>";
        }


        # End the table
        echo "</TABLE>";

        # Free up the results in memory
        mysqli_free_result($results);
    }
}

#get all information for the record and only return the set of desired fields, not including null ones
function show_record($dbc, $id, $status = 'not specified') {

    /*
    id INT PRIMARY KEY AUTO_INCREMENT,
	finder_id INT,
	owner_id INT,
	location_id INT NOT NULL,
	create_date DATETIME NOT NULL DEFAULT NOW(),
	update_date DATETIME NOT NULL DEFAULT NOW(),
	item_lost_date DATETIME,
	item_name VARCHAR(30) NOT NULL,
	item_description VARCHAR(200) NOT NULL,
	room TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL,
	item_category SET('phone or computer', 'audio or headphones', 'clothing', 'notebook or books', 'bag or backpack', 'other'),
	make TEXT,
	model TEXT,
	color TEXT,
	reward INT,
	item_image VARCHAR(254)
    */

    #return everything about item
    $query = 'SELECT * FROM item WHERE id=' . $id . ';';
    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    $resArray = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ;

    check_results($results) ;

    #if the query succeeded
    if($results) {
        #get location information
        $queryLoc = 'SELECT locations.name FROM locations, item WHERE item.id=' . $id . ' AND item.location_id = locations.id ;';
        $resultLoc = mysqli_query( $dbc , $queryLoc ) ;
        $resArrayLoc = mysqli_fetch_array( $resultLoc , MYSQLI_ASSOC ) ;
        $location = $resArrayLoc['name'];
        if($status == 'lost') {
            #item.id, location.name, item.create_date, item.item_name, item.item_description, item.item_category, item.room, item.make, item.model, item.color, item.reward
            echo '<H1>Found Items</H1>' ;
            echo '<table class ="table table-striped">';
            echo '<TR>';
            echo '<th>Item ID</th>';
            echo '<th>Location</th>';
            #check certain fields to see if they're set
            if(isset($resArray['room'])) {
                echo '<th>Room</th>';
            }
            echo '<th>Date Created</th>';
            echo '<th>Item Name</th>';
            echo '<th>Item Description</th>';
            echo '<th>Item Category</th>';
            #check certain fields to see if they're set
            if(isset($resArray['make'])){
                echo '<th>Make</th>';
            }
            if(isset($resArray['model'])){
                echo '<th>Model</th>';
            }
            if(isset($resArray['color'])){
                echo '<th>Color</th>';
            }
            if(isset($resArray['reward'])){
                echo '<th>Reward</th>';
            }
            #end table heading
            echo '</TR>';
            # Make result for each row
            echo '<TR>' ;
            echo '<TD>' . $resArray['id'] . '</TD>' ;
            echo '<TD>' . $location . '</TD>' ;
            if(isset($resArray['room'])) {
                echo '<TD>' . $resArray['room'] . '</TD>' ;
            }
            echo '<TD>' . $resArray['create_date'] . '</TD>' ;
            echo '<TD>' . $resArray['item_name'] . '</TD>' ;
            echo '<TD>' . $resArray['item_description'] . '</TD>' ;
            echo '<TD>' . $resArray['item_category'] . '</TD>' ;
            if (isset($resArray['make'])) {
                echo '<TD>' . $resArray['make'] . '</TD>' ;
            }
            if(isset($resArray['model'])){
                echo '<TD>' . $resArray['model'] . '</TD>' ;
            }
            if(isset($resArray['color'])){
                echo '<TD>' . $resArray['color'] . '</TD>' ;
            }
            if(isset($resArray['reward'])){
                echo '<TD>' . $resArray['reward'] . '</TD>' ;
            }
            echo '</TR>' ;

            # End the table
            echo '</TABLE>';
        }
    }
    mysqli_free_result( $results ) ;
    mysqli_free_result( $resultLoc ) ;
/*
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
*/
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
 * ==================================
 * Convert vernacular search query to DATETIME
 */
#how long ago -> php date -> MySQL datetime comparison
function selectToMySQL($timeAgo) {
	#get the current time in PHP format
	if ($timeAgo === 'today') {
		#convert current time into SQL date
		$theDate = date( 'Y-m-d H:i:s') ;
		$returnDate = array('today', $theDate) ;
		return $returnDate ;
	}
	elseif ($timeAgo === 'yesterday') {
		$phpDate = (time() - dayToUnixSecs(1)) ; #subtract 1 day from current time
		$theDate = date( 'Y-m-d H:i:s', $phpDate) ; #convert to MySQL date
		$returnDate = array('yesterday', $theDate); #put it in an array for query building
		return $returnDate ;
	}
	elseif ($timeAgo === '2 to 7 days') {
		$phpDate = (time() - dayToUnixSecs(2)); #subtract 2 days from current time
		$mySQLDate1 = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date

		$phpDate = (time() - dayToUnixSecs(7)); #subtract 7 days from current time
		$mySQLDate2 = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date
		#return range of dates
		$returnDate = array('2 to 7 days',$mySQLDate1, $mySQLDate2); #put in an array for query building
		return $returnDate ;
	}
	elseif ($timeAgo === 'longer than a week') {
		#subtract 8 days and convert to SQL date
		$phpDate = (time() - dayToUnixSecs(8)); #subtract 8 days
		$theDate = date('Y-m-d H:i:s', $phpDate); #convert to MySQL date
		$returnDate = array('longer than a week', $theDate); #put in an array for query building
		return $returnDate;

	}
}

function dayToUnixSecs($days) {
    $seconds = 86400 * $days ;
    return $seconds;

}
/*
 * ================================================
 * error functions
 * ================================================
 */
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

?>

</html>


