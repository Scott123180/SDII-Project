<!DOCTYPE html>
<!--
Authors: Scott Hansen and Nicholas Burd
Title: about.php
Description: Help page and page about the web app.
-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>About Limbo</title>
</head>
<body>
    <div class="container-fluid" style="background-color:#aaaaaa">
        <div class="row">
            <div class="span4"></div>
            <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/LimboCompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
            <div class="span4"></div>
        </div>
    </div>

    <!--header-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php" style="color:white;"><h4>Lost Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php" style="color:white;"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php" style="color:white;"><h4>About</h4></a></div>
        </div>
    </div>
    <div class="container">
        <h1>About</h1>
        <h3>About Limbo DB</h3>
		<p>Limbo DB allows students accross the Marist Campus to report items they have either lost or found. Users may search through the lost and found to find their own lost items or to check if an item they found has been reported lost.</p>
        <h3>Q&A</h3>
        <h4>How do I report an item that I have found?</h4>
        <p>Click the 'Found Something?' button and fill out the required information regarding the item. If the information entered matches an item already reported lost, then you will be able to return the item to its owner. However if the item you have found has not already been lost then you may report a new found item.</p>
        <h4>How do I report an item that I have Lost?</h4>
        <p>Click the 'Lost Something?' button and fill out the required information regarding the item. If the information entered matches an item already reported found, then you may claim the item. However if the item you lost has not been found yet then you may report a new lost item.</p>
    </div>
</body>
</html>