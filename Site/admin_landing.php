<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Manage LimboDB</title>
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
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="found.php"><h4>Found Something?</h4></a></div>
            <div class="col-md-4" style="background-color:#cc0000; text-align:center"><a href="about.php"><h4>About</h4></a></div>
        </div>
    </div>
    <br />

    <!--Button Container-->
    <div class="container">
        <!--Row 1-->
        <div class="row">
            <div class="col-md-6">
                <a href="admin_statistics.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Statistics</button>
            </div>
            <div class="col-md-6">
				<a href="admin_profile.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Profile</button>
            </div>
        </div>

        <!--Row 2-->
        <div class="row">
            <div class="col-md-6">
				<button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">DB Maintenance</button>
            </div>
            <div class="col-md-6">
                <a href="admin_profile.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Add an Admin</button>
            </div>
        </div>
		
		<!--Row 3-->
        <div class="row">
            <div class="col-md-6">
				<a href="admin_profile.php"><button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:15px">Add an Admin</button>
            </div>
        </div>
    </div>
</body>
</html>