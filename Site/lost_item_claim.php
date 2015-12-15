<?php session_start(); #start session to get itemClaimNumber
#Authors: Scott Hansen and Nicholas Burd
#File Description: claim a lost item
?>
<!DOCTYPE html>
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
    <h1>Thanks for claiming this item!</h1>
    <p>The finder's contact information is below. Please email them in order to retrieve your item. Thanks for using Marist's Limbo DB!</p>
    <?php
    require ( '../connect_db.php' );
    require ( 'php_includes/helpers.php' );
    #get the id of the item from the session
    $id = $_SESSION['itemClaimNumber'];
    #get the contact_name and contact_email
    $query = 'SELECT contact_name, contact_email FROM item WHERE id=' . $id . ';';
    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    $resArray = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ;
    check_results($results) ;

    $contact_name = $resArray['contact_name'];
    $contact_email = $resArray['contact_email'];

    #claim the item
    if(claim_item($dbc, $id)){ #success
        echo "<p style='color: blue'>Item claimed successfully.</p>";
    }
    else { #not claimed successfully
        echo "<p style='color: red'>Error. Please try again.</p>";
    }

    mysqli_free_result($results);
    mysqli_close($dbc);

    echo "<h3>Contact Name: {$contact_name}";
    echo "<h3>Contact Email: <a href=\"mailto:{$contact_email}\">{$contact_email}</a></h3>"
    ?>
</div>
</body>
</html>