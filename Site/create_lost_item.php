<!DOCTYPE html>
<!--Places that need PHP are designated by NPHP-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/helpers.js"></script>

    <title>Lost Something</title>
</head>
<body>
    <div class="container-fluid" style="background-color:#aaaaaa">
        <div class="row">
            <div class="span4"></div>
            <div class="span4"><a href="index.php"><img class="img-responsive center-block" src="images/limbocompressed.png" style="padding-bottom:20px; padding-top:10px" /></a></div>
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

    <!--select options-->
    <div class="container">
        <form class="form-group">
            <h4>What location did you lose it at?</h4>
            <select class="form-control" name="campLoc" id="campLoc">
                <option>location</option>
                <script>makeOptions(campusLocations, "campLoc")</script>
                <option>unknown</option>
            </select>

            <h4>When did you lose it?</h4>
            <input type="date" class="form-control" name="date_lost">

            <h4>What is name of the item?</h4>
            <input type="text" class="form-control" placeholder="example: scarf, bologna, laptop" name="name">

            <h4>Please describe the item:</h4>
            <textarea class="form-control" rows="3" placeholder="description" name="description"></textarea>

            <h4>What room did you lose it in?</h4>
            <input type="text" class="form-control" placeholder="example: 303, 202, et cetera" name="room">

            <h4>Item Category</h4>
            <select class="form-control" name="iCat" id="iCat">
                <option>item category</option>
                <script>makeOptions(itemCategories, "iCat");</script>
            </select>

            <h4>What is the item's make?</h4>
            <input type="text" class="form-control" placeholder="example: apple, microsoft, nordstrom, et. cetera" name="make">

            <h4>What is the item's color?</h4>
            <input type="text" class="form-control" placeholder="item color" name="color">

            <h4>Do you wish to offer a reward for the item?</h4>
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group" id="reward" name="reward">
                <div class="input-group-addon">$</div>
                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
                <div class="input-group-addon">.00</div>
            </div>


            <input type="submit" class="form-control" name = 'submitFilter' value="Submit" style="margin-top: 15px" />
            <br/>
        </form>
        <br/>
    </div>
</body>
</html>