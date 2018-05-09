<?php
require '../include/interestsObject.php';
require '../include/session.php';
require '../include/connection.php';
require '../include/topnav.php' ;

if (isset($_GET['success'])) {
  echo "<div class='alert alert-success col-sm-10 col-sm-offset-1' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          Settings Succesfully Updated
        </div>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Personality Profile</title>
  </head>

  <body>
    <div>
      <div class="interests-box col-xs-offset-1 col-xs-10">
        <h1>Select your interests</h1>
        <form  class="col-xs-12" action="../postLogin/submitInterests.php" method="post">
          <div class="col-xs-12">
            <div class="col-xs-12">
              <?php
                if (!isset($_SESSION['interests'])) {
                  $interests = new Interests($conn, $_SESSION['id']);
                  $_SESSION['interests'] = $interests;
                } else {
                  $interests = $_SESSION['interests'];
                }
                $interests->createAndPopulateCheckboxes();
              ?>
            </div>
          </div>
        <div class="buttonHolder">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
        </form>
      </div>
    </div>
  </body>

</html>
