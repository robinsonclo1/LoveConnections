<?php
require '../include/interestsObject.php';
require '../include/session.php';
require '../include/connection.php';
require '../include/topnav.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Match Members (WIP)</title>
  </head>

  <body>
    <div>
    <div class="interests-box interest-match-box col-xs-offset-1 col-xs-6">
      <h1>Select your match criteria</h1>
      <form  class="col-xs-12" action="../postLogin/submitInterests.php" method="post">

          <div>
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
      <div class="buttonHolder">
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
    <div class="unmatched interests-box col-xs-offset-1 col-sm-3">
      <h1>Unmatched</h1>
      
    </div>

  </body>
</html>
