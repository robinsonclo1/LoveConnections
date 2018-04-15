<?php
  require '../include/connection.php';
  require '../include/session.php';
  require "../include/topnav.php";
  require "../include/editUsers.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Change Settings</title>
  </head>

  <body>
    <h1>Change Settings</h1>
    <div class="container-fluid">
  	  <div class="col-md-6 col-md-offset-3">
  	    <div class="sign-up-box">

  		  <form class="changePasswordBox" action="#" method="post">
          <h2>New Password</h2>
          <input type="password" name="newFirstPassword" placeholder="8 characters or more" required/>
          <h2>Confirm New Password</h2>
          <input type="password" name="newSecondPassword" required/>

          <button class="btn btn-primary" type="submit">Submit</button>
          <input class="btn btn-primary" type="reset">
        </form>
  	  </div>
  	</div>
  </body>
</html>
