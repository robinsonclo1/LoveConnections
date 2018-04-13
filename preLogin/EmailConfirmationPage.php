<?php
  require '../include/connection.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../include/main.css">
    <script src="../include/javaScriptMain.js" type="text/javascript"></script>
  </head>
  <body>

    <header class="container-fluid">
      <div class="topnav">
        <h1 class="col-md-6 col-sm-6 siteName"><a href='../preLogin/homepage.php'>Love Connections</a></h1>
      </div>
    </header>

  <div class="col-md-12">
		<?php
      //most of this should actually happen on the sign up page...

			//Organization
			  $organization = ($_POST["organization"]);

        if ($organization == "true") {
          $organization = "1";
          $organizationName = trim($_POST["organizationName"]);
        } else {
          $organization = "0";
          $organizationName = "";
        }

				$firstName = trim(htmlspecialchars($_POST["firstName"]));
				$lastName = trim(htmlspecialchars($_POST["lastName"]));
				$firstEmail = trim(htmlspecialchars($_POST["firstEmail"]));
				$secondEmail = trim(htmlspecialchars($_POST["secondEmail"]));
				$firstPassword = trim(htmlspecialchars($_POST["firstPassword"]));
				$secondPassword = trim(htmlspecialchars($_POST["secondPassword"]));

				if (is_null($firstEmail) || is_null($secondEmail) || is_null($firstPassword) || is_null($secondPassword)){
				    echo "<p class='error'>Please verify that all values were entered correctly on the <a href='./'>previous form.</a></p> <br>";
				} else if ($firstEmail != $secondEmail) {
				    echo "<p class='error'>Please verify that both emails match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else if ($firstPassword != $secondPassword) {
					echo "<p class='error'>Please verify that both passwords match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else {
					//SQL insert First
					$checkEmailsSQL = "SELECT * FROM memberInfo WHERE (email = '" . $firstEmail . "');";
					$stepTwo = mysqli_query($conn, $checkEmailsSQL);
					if (mysqli_num_rows($stepTwo) > 0) {
						echo "<br><p>We're sorry, that email already has an account.</p>";
					} else {
						$passwordHash = password_hash($firstPassword, PASSWORD_DEFAULT);

						$insertInfoSQL = "insert into MemberInfo (organization, organizationName, email, password, firstName, lastName)
						VALUES('" . $organization . "', '" . $organizationName . "', '" . $firstEmail . "', '" . $passwordHash . "', '" . $firstName . "', '" . $lastName . "' );" ;

            if ($conn->query($insertInfoSQL) === TRUE) {
							echo "<h2>Welcome to Love Connections!</h2>";
							echo "<br><p>An email was sent to " . $firstEmail . ". Please follow the link to activate your account.</p>";
							echo "<p>If you did not recieve an email, click here.</p>";
						} else {
							echo "<p>Unfortunately an error occured. Please go back and reenter your information</p>";
						}
					}
				}

			?> 	</div>
  </body>
</html>
