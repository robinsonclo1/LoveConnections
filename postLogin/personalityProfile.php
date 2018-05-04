<?php
require '../include/connection.php';
require '../include/session.php';
require "../include/topnav.php" ;

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
          <div class="col-md-4 col-sm-6" style="text-align:center;">
        	  <div id="athletics">
              <h3>Athletics</h3>
          	  <?php
                interestButton('basketball');
                interestButton('bowling');
                interestButton('cheer');
                interestButton('dance');
                interestButton('football');
                interestButton('golf');
                interestButton('gymnastics');
                interestButton('lacrosse');
                interestButton('soccer');
                interestButton('softball');
                interestButton('swimming');
                interestButton('tennis');
                interestButton('track');
                interestButton('volleyball');
              ?>
          	</div>
          </div>
          <div class="col-md-4 col-sm-6" style="text-align:center;">
    				<div id="academic">
  				    <h3>Academic</h3>
              <?php
                interestButton('mathematics');
                interestButton('science');
                interestButton('reading');
                interestButton('history');
                interestButton('languages');
                interestButton('agriculture');
              ?>
    				</div>
            <div id="community">
              <h3>Religion & Politics</h3>
              <?php
                interestButton('church');
                interestButton('politics');
                interestButton('liberal');
                interestButton('conservative');
                interestButton('independent');
              ?>
            </div>
          </div>
          <div class="col-md-4 col-sm-12" style="text-align:center;">
    				<div id="artistic">
    				  <h3>Arts & Music</h3>
              <?php
                interestButton('art');
                interestButton('music');
                interestButton('singing');
                interestButton('orchestra');
                interestButton('band');
                interestButton('acting');
                interestButton('fashion');
                interestButton('movies');
              ?>
    				</div>
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
