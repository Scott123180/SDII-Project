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
		require( 'php_includes/connect_db.php' ) ;
		global $dbc;
		
		session_start( );
		if (!isset($_SESSION["username"])){
			header("location: admin_logon.php");
		}
		
		#AMOUNT OF ITEMS IN DATABASE
		$itemCount;
		$query = "SELECT COUNT(item_name) as total FROM item";
		#show_query($query) ;
		$result = mysqli_query( $dbc, $query ) ;
		$row = mysqli_fetch_assoc($result);
		$itemCount=$row['total'];
		
		#AMOUNT OF LOST ITEMS
		$lostCount;
		$query2 = "SELECT COUNT(item_name) as total FROM item WHERE status='lost'";
		#show_query($query2) ;
		$result2 = mysqli_query( $dbc, $query2 ) ;
		$row2 = mysqli_fetch_assoc($result2);
		$lostCount=$row2['total'];
		
		#AMOUNT OF FOUND ITEMS
		$foundCount;
		$query3 = "SELECT COUNT(item_name) as total FROM item WHERE status='found'";
		#show_query($query3) ;
		$result3 = mysqli_query( $dbc, $query3 ) ;
		$row3 = mysqli_fetch_assoc($result3);
		$foundCount=$row3['total'];
		
		#AMOUNT OF CLAIMED ITEMS
		$claimedCount;
		$query4 = "SELECT COUNT(item_name) as total FROM item WHERE status='claimed'";
		#show_query($query4) ;
		$result4 = mysqli_query( $dbc, $query4 ) ;
		$row4 = mysqli_fetch_assoc($result4);
		$claimedCount=$row4['total'];
		
		
		#SPECIFIC ITEM CATEGORIES
		
		#AMOUNT OF PHONES OR COMPUTERS LOST
		$phoneOrComputerLostCount;
		$query5 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='phone or computer' AND status='lost'";
		#show_query($query5) ;
		$result5 = mysqli_query( $dbc, $query5 ) ;
		$row5 = mysqli_fetch_assoc($result5);
		$phoneOrComputerLostCount=$row5['total'];
		
		#AMOUNT OF PHONES OR COMPUTERS FOUND
		$phoneOrComputerFoundCount;
		$query6 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='phone or computer' AND status='found'";
		#show_query($query6) ;
		$result6 = mysqli_query( $dbc, $query6 ) ;
		$row6 = mysqli_fetch_assoc($result6);
		$phoneOrComputerFoundCount=$row6['total'];
		
		#AMOUNT OF PHONES OR COMPUTERS CLAIMED
		$phoneOrComputerClaimedCount;
		$query7 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='phone or computer' AND status='claimed'";
		#show_query($query7) ;
		$result7 = mysqli_query( $dbc, $query7 ) ;
		$row7 = mysqli_fetch_assoc($result7);
		$phoneOrComputerClaimedCount=$row7['total'];
		
		#AMOUNT OF AUDIO OR HEADPHONES LOST
		$audioOrHeadphonesLostCount;
		$query8 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='audio or headphones' AND status='lost'";
		#show_query($query8) ;
		$result8 = mysqli_query( $dbc, $query8 ) ;
		$row8 = mysqli_fetch_assoc($result8);
		$audioOrHeadphonesLostCount=$row8['total'];
		
		#AMOUNT OF AUDIO OR HEADPHONES FOUND
		$audioOrHeadphonesFoundCount;
		$query9 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='audio or headphones' AND status='found'";
		#show_query($query9) ;
		$result9 = mysqli_query( $dbc, $query9 ) ;
		$row9 = mysqli_fetch_assoc($result9);
		$audioOrHeadphonesFoundCount=$row9['total'];
		
		#AMOUNT OF AUDIO OR HEADPHONES CLAIMED
		$audioOrHeadphonesClaimedCount;
		$query10 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='audio or headphones' AND status='claimed'";
		#show_query($query10) ;
		$result10 = mysqli_query( $dbc, $query10 ) ;
		$row10 = mysqli_fetch_assoc($result10);
		$audioOrHeadphonesClaimedCount=$row10['total'];
		
		#AMOUNT OF CLOTHING LOST
		$clothingLostCount;
		$query11 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='clothing' AND status='lost'";
		#show_query($query11) ;
		$result11 = mysqli_query( $dbc, $query11 ) ;
		$row11 = mysqli_fetch_assoc($result11);
		$clothingLostCount=$row11['total'];
		
		#AMOUNT OF CLOTHING FOUND
		$clothingFoundCount;
		$query12 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='clothing' AND status='found'";
		#show_query($query12) ;
		$result12 = mysqli_query( $dbc, $query12 ) ;
		$row12 = mysqli_fetch_assoc($result12);
		$clothingFoundCount=$row12['total'];
		
		#AMOUNT OF CLOTHING CLAIMED
		$clothingClaimedCount;
		$query13 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='clothing' AND status='claimed'";
		#show_query($query13) ;
		$result13 = mysqli_query( $dbc, $query13 ) ;
		$row13 = mysqli_fetch_assoc($result13);
		$clothingClaimedCount=$row13['total'];
		
		#AMOUNT OF NOTEBOOK OR BOOK LOST
		$notebookOrBookLostCount;
		$query14 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='notebook or book' AND status='lost'";
		#show_query($query14) ;
		$result14 = mysqli_query( $dbc, $query14 ) ;
		$row14 = mysqli_fetch_assoc($result14);
		$notebookOrBookLostCount=$row14['total'];
		
		#AMOUNT OF NOTEBOOK OR BOOK FOUND
		$notebookOrBookFoundCount;
		$query15 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='notebook or book' AND status='found'";
		#show_query($query15) ;
		$result15 = mysqli_query( $dbc, $query15 ) ;
		$row15 = mysqli_fetch_assoc($result15);
		$notebookOrBookFoundCount=$row15['total'];
		
		#AMOUNT OF NOTEBOOK OR BOOK CLAIMED
		$notebookOrBookClaimedCount;
		$query16 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='notebook or book' AND status='claimed'";
		#show_query($query16) ;
		$result16 = mysqli_query( $dbc, $query16 ) ;
		$row16 = mysqli_fetch_assoc($result16);
		$notebookOrBookClaimedCount=$row16['total'];
		
		#AMOUNT OF BAG OR BACKPACK LOST
		$bagOrBackpackLostCount;
		$query17 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='bag or backpack' AND status='lost'";
		#show_query($query17) ;
		$result17 = mysqli_query( $dbc, $query17 ) ;
		$row17 = mysqli_fetch_assoc($result17);
		$bagOrBackpackLostCount=$row17['total'];
		
		#AMOUNT OF BAG OR BACKPACK FOUND
		$bagOrBackpackFoundCount;
		$query18 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='bag or backpack' AND status='found'";
		#show_query($query18) ;
		$result18 = mysqli_query( $dbc, $query18 ) ;
		$row18 = mysqli_fetch_assoc($result18);
		$bagOrBackpackFoundCount=$row18['total'];
		
		#AMOUNT OF BAG OR BACKPACK CLAIMED
		$bagOrBackpackClaimedCount;
		$query19 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='bag or backpack' AND status='claimed'";
		#show_query($query19) ;
		$result19 = mysqli_query( $dbc, $query19 ) ;
		$row19 = mysqli_fetch_assoc($result19);
		$bagOrBackpackClaimedCount=$row19['total'];
		
		#AMOUNT OF OTHER LOST
		$otherLostCount;
		$query20 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='other' AND status='lost'";
		#show_query($query20) ;
		$result20 = mysqli_query( $dbc, $query20 ) ;
		$row20 = mysqli_fetch_assoc($result20);
		$otherLostCount=$row20['total'];
		
		#AMOUNT OF OTHER FOUND
		$otherFoundCount;
		$query21 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='other' AND status='found'";
		#show_query($query21) ;
		$result21 = mysqli_query( $dbc, $query21 ) ;
		$row21 = mysqli_fetch_assoc($result21);
		$otherFoundCount=$row21['total'];
		
		#AMOUNT OF OTHER CLAIMED
		$otherClaimedCount;
		$query22 = "SELECT COUNT(item_name) as total FROM item WHERE item_category='other' AND status='claimed'";
		#show_query($query22) ;
		$result22 = mysqli_query( $dbc, $query22 ) ;
		$row22 = mysqli_fetch_assoc($result22);
		$otherClaimedCount=$row22['total'];
		
		
	?>
    <div class="container">
		<h1 align="center">Statistics</h1>
		<table align="center">
				<tr>
				<td><h4>Number of Items in Database: </h4></td><td><?php echo $itemCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Lost Items: </h4></td><td><?php echo $lostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Found Items: </h4></td><td><?php echo $foundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Claimed Items: </h4></td><td><?php echo $claimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Phones or Computers Lost: </h4></td><td><?php echo $phoneOrComputerLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Phones or Computers Found: </h4></td><td><?php echo $phoneOrComputerFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Phones or Computers Claimed: </h4></td><td><?php echo $phoneOrComputerClaimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Audio/Headphones Lost: </h4></td><td><?php echo $audioOrHeadphonesLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Audio/Headphones Found: </h4></td><td><?php echo $audioOrHeadphonesFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Audio/Headphones Claimed: </h4></td><td><?php echo $audioOrHeadphonesClaimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Clothing Lost: </h4></td><td><?php echo $clothingLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Clothing Found: </h4></td><td><?php echo $clothingFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Clothing Claimed: </h4></td><td><?php echo $clothingClaimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Notebooks/Books Lost: </h4></td><td><?php echo $notebookOrBookLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Notebooks/Books Found: </h4></td><td><?php echo $notebookOrBookFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Notebooks/Books Claimed: </h4></td><td><?php echo $notebookOrBookClaimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Bag/Backpacks Lost: </h4></td><td><?php echo $bagOrBackpackLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Bag/Backpacks Found: </h4></td><td><?php echo $bagOrBackpackFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Bag/Backpacks Claimed: </h4></td><td><?php echo $bagOrBackpackClaimedCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Other Lost: </h4></td><td><?php echo $otherLostCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Other Found: </h4></td><td><?php echo $otherFoundCount; ?></td>
				</tr>
				<tr>
				<td><h4>Number of Other Claimed: </h4></td><td><?php echo $otherClaimedCount; ?></td>
				</tr>
		</table>
    </div>
	<div class="container">
	<!--Row 2-->
        <div class="row">
            <div class="col-md-6">
				<a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Logout</button>
            </div>
			<div class="col-md-6">
				<a href="admin_landing.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Admin Page</button>
            </div>
        </div>
	</div>
</body>
</html>