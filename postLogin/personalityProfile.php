<?php
require '../include/connection.php';
require '../include/session.php';
require '../include/topnav.php' ;
require '../include/interestsObject.php';

function interestButton($interest){
  echo "<label class='interest-container container'>" . ucfirst($interest) . "
          <input type='checkbox' name='interestList[]' id='$interest' value='$interest'>
          <span class='checkmark'></span>
        </label>";
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
                $interests = new Interests($conn, $_SESSION['id']);
                $interests->createAndPopulateCheckboxes();
              ?>
            </div>
          </div>
        <div class="buttonHolder">
          <button class="btn btn-primary" type="submit">Submit</button>
          <input class="btn btn-primary" type="reset">
        </div>
        </form>
      </div>
    </div>
  </body>

</html>
