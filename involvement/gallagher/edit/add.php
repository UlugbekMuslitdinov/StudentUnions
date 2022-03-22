<?php
include_once('functions.php');
loginCheck();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add Gallagher Movie Schedule</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style/jquery.timepicker.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" href="style/add.css">
  </head>
  <body>
    <?php include_once('navbar.view.php'); ?>
    <div class="container">
      <div class="col-sm-3"></div>
      <form class="col-sm-6" method="POST" action="add.post.php">
        <div class="col-sm-12">
          <a href="edit.php" class="btn col-sm-12 back-btn"><span class="glyphicon glyphicon-menu-left" aria-hidden="true" alt="back to edit"></span></a>
        </div>
        <div class="wrap-add col-sm-12" id="addBoxes">
          <input type="hidden" name="count" id="addBoxCount" value="0">
          <!-- add box goes here -->
        </div>
        <div class="wrap-add-control col-sm-12">
          <button type="button" class="col-sm-6 btn btn-moremovie" onclick="addMoreMovie();">More Movie</button>
          <button type="submit" class="col-sm-6 btn btn-submit" type="submit">Add</button>
        </div>
      </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/add.js"></script>
    <script type="text/javascript">
      // Since add.js is used in edit.php
      addMoreMovie();
    </script>
  </body>
</html>