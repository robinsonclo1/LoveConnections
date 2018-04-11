<?php
  $conn = new mysqli('localhost', 'root', '', 'loveConnections');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
<?php include "topnav.php" ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sign-Up</title>
  </head>

  <body>



	<div class="container-fluid">
	  <div class="col-md-6 col-md-offset-3">
	    <div class="sign-up-box">
		    <h2>Are you joining as an organization or an event participant?</h2>
          <button class="btn btn-primary" id="organizationBtn" name="organization">Organization / Organizer</button>
	        <button class="btn btn-primary" id="participantBtn" name="participant">Participant</button>
		  </div>

      <!-- These forms are hidden/displayed in the javaScriptMain file -->
		  <form class="sign-up-box organizationBox" action="EmailConfirmationPage.php" method="post">
        <input type="hidden" class="orgBoolInput" name="organization" value = "true" />

	      <h2 class="orgName">Organization Name</h2>
		    <input type="text" name="organizationName" class="orgName" autofocus />

		    <h2 class="firstName">First Name</h2>
        <input type="text" name="firstName" required/>

        <h2 class="lastName">Last Name</h2>
        <input type="text" name="lastName" required/>

        <h2>E-mail</h2>
        <input type="email" placeholder="Use an official email" name="firstEmail" value="<?= $_POST['firstEmail'] ?? '' ?>"required/>
        <h2>Confirm E-mail</h2>
        <input type="email" name="secondEmail" value="<?= $_POST['secondEmail'] ?? '' ?>"required/>

        <h2>Password</h2>
        <input type="password" name="firstPassword" placeholder="8 characters or more" required/>
        <h2>Confirm Password</h2>
        <input type="password" name="secondPassword" required/>

        <button class="btn btn-primary" type="submit">Submit</button>
        <input class="btn btn-primary" type="reset">
      </form>
	  </div>
	</div>


  </body>
</html>
