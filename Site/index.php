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
            <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/limbocompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
            <div class="span4"></div>
        </div>
    </div>

    <div class="container-fluid">

       <!--Header-->
        <div class="row">
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="lost.php"><h4>Lost Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center" ><a href="found.php"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php"><h4>About</h4></a></div>
        </div>
    </div>
    <div class="container">
        <!--Welcome Message-->
        <h1>Welcome to Limbo Lost and Found</h1>
        <p>If you have lost or found something, you're in luck; this is the place to report it.</p>
        <!--Quick Lost and Found Table-->
        <h3>Recent Activity</h3> <!--Insert option menu here-->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date/time</th>
                    <th>Status</th>
                    <th>Stuff</th>
                </tr>
            </thead>
            <!--NPHP: Need to code in PHP to make table-->
            <tbody>
                <tr>
                    <td>Sample Datetime</td>
                    <td>Sample Status</td>
                    <td>Sample Item</td>
                </tr>
                <tr>
                    <td>Sample Datetime</td>
                    <td>Sample Status</td>
                    <td>Sample Item</td>
                </tr>
                <tr>
                    <td>Sample Datetime</td>
                    <td>Sample Status</td>
                    <td>Sample Item</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>