<?php
session_start();

$name = $_SESSION['name'];
$description = $_SESSION['description'];
$category = $_SESSION['category'];
$location = $_SESSION['location'];

require ( '../connect_db.php' );
?>
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
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 300px;
            width: 300px;
        }
    </style>
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
<h1 style="text-align: center">Thanks for your submission!</h1>
    <?php
    #query for location id
    $query = 'SELECT * FROM locations, item WHERE item.location_id = locations.id AND locations.name = \'' . $location . '\' ;' ;
    echo $query ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    $latitude = $row['latitude'] ;
    $longitude = $row['longitude'] ;
    mysqli_free_result($results);

    #print out the info for the item
    echo "<h3>Item Name: {$name}</h3>";
    echo "<h3>Description: {$description}</h3>";
    echo "<h3>Category: {$category}";
    echo "<h3>Location: {$location}</h3>";
    ?>
    <div id="map"></div>
    <br/>
    <!-- Google Map API -->
    <script>
        var buildingLat = <?php echo $latitude ?>;
        var buildingLng = <?php echo $longitude ?>;
        function initMap() {
            var myLatLng = {lat: buildingLat, lng: buildingLng};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
            });
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOEhES_Kpvjxu9D2vEgFjbcHyu9tvyOBg&signed_in=true&callback=initMap"></script>
</div>
</body>
</html>