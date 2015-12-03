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
	<?php
		require( 'php_includes/helpers.php' ) ;
		require( 'php_includes/connect_db.php' ) ;
		global $dbc;
		
		$itemCount;
		$query = "SELECT COUNT(item_name) as total FROM item";
		#show_query($query) ;
		$result = mysqli_query( $dbc, $query ) ;
		$row = mysqli_fetch_assoc($result);
		$itemCount=$row['total'];
		
		$lostCount;
		$query2 = "SELECT COUNT(item_name) as total FROM item WHERE status='lost'";
		#show_query($query2) ;
		$result2 = mysqli_query( $dbc, $query2 ) ;
		$row2 = mysqli_fetch_assoc($result2);
		$lostCount=$row2['total'];
		
		$foundCount;
		$query3 = "SELECT COUNT(item_name) as total FROM item WHERE status='found'";
		#show_query($query3) ;
		$result3 = mysqli_query( $dbc, $query3 ) ;
		$row3 = mysqli_fetch_assoc($result3);
		$foundCount=$row3['total'];
		
		$claimedCount;
		$query4 = "SELECT COUNT(item_name) as total FROM item WHERE status='claimed'";
		#show_query($query4) ;
		$result4 = mysqli_query( $dbc, $query4 ) ;
		$row4 = mysqli_fetch_assoc($result4);
		$claimedCount=$row4['total'];
		
		
	?>
    <div class="container">
		<h1 align="center">Statistics</h1>
		<table align="center">
				<tr>
				<td><h3>Number of Items in Database: </h3></td><td><?php echo $itemCount; ?></td>
				</tr>
				<tr>
				<td><h3>Number of Lost Items: </h3></td><td><?php echo $lostCount; ?></td>
				</tr>
				<tr>
				<td><h3>Number of Found Items: </h3></td><td><?php echo $foundCount; ?></td>
				</tr>
				<tr>
				<td><h3>Number of Claimed Items: </h3></td><td><?php echo $claimedCount; ?></td>
				</tr>
		</table>
    </div>
</body>
</html>