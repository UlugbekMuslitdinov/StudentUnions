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
    <title>Edit Gallagher Movie Schedule</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style/jquery.timepicker.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" href="style/edit.css">
  </head>
  <body>
    <?php include_once('navbar.view.php'); ?>
    <div class="container">
      <div class="controller col-sm-12">
        <a class="btn btn-default" href="add.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        <a class="btn btn-default" href="/involvement/gallagher/index.php">Go to the Page</span></a>
      </div>
      <table class="table table-striped">
        <thead> <tr> <th>Start Date</th> <th>End Date</th> <!-- <th>Time</th> --> <th>Movie Name</th> <th>Edit</th> <th>Delete</th> </tr> </thead>
        <?php
        include_once('functions.php');
        $data = getJson();
        $print ='';
        for ($i=0; $i < count($data); $i++) { 
          $print .= '<tr id="row'.$i.'">';
          $print .= '<td>'.date("m/d/Y", strtotime($data[$i]["start_date"])).'</td>';
          $print .= '<td>'.date("m/d/Y", strtotime($data[$i]["end_date"])).'</td>';

          // Time column
          $print .= '<td style="display: none;">';
          foreach ($data[$i]["time"] as $value) {
            $print .= $value.'<br>';
          }
          $print .= '</td>';


          $print .= '<td>';
          foreach ($data[$i]["name"] as $value) {
            $print .= $value.'<br>';
          }
          $print .= '</td>';
          $print .= '<td><button class="btn btn-default" onclick="editRow('.$i.')" data-toggle="modal" data-target="#myModal">edit</button></td>';
          $print .= '<td><button class="btn btn-default" onclick="deleteRow('.$i.');">delete</button></td>';
          $print .= '</tr>';
        }
        echo $print;
        ?>
      </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content col-sm-12">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <form  method="POST" action="edit.post.php" id="editForm">
            <div class="modal-body col-sm-12">
              <input type="hidden" name="id" id="id" value="">
              <input type="hidden" name="action" id="action" value="">
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                  <input type="text" class="form-control datepicker" id="date" name="date" aria-describedby="date" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                  <input type="text" class="form-control datepicker" id="end_date" name="end_date" aria-describedby="end_date" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" required>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- Times -->
                <div class="movie-time1" id="movie_time1">
                </div>
                <button type="button" class="btn btn-default more-time-btn col-sm-12" onclick="addMoreTime(1);"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
              </div>
              <!-- Names -->
              <div class="col-sm-12">
                <div class="movie-names1" id="movie_names1">
                </div>
                <button type="button" class="btn btn-default more-names-btn col-sm-12" onclick="addMoreNames(1);"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
              </div>

            </div>
            <div class="modal-footer col-sm-12">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/add.js"></script>
    <script src="js/edit.js"></script>
  </body>
</html>