<?php 
  $conn = new mysqli('localhost', 'root', '', 'loveConnections');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="javaScriptMain.js" type="text/javascript"></script>
  </head>
  <body>
  
  <div class="topnav">	  
	  <h1 class="col-md-6 col-sm-6 siteName"><a href='homepage.php'>Love Connections</a></h1>
  </div>
	
	<div class="col-md-12">
		<?php 
      //most of this should actually happen on the sign up page...
    
			//Organization
			if (isset($_POST['contactFirstName'])) {
				
				$organizationName = trim($_POST["organizationName"]);
				$firstName = trim($_POST["contactFirstName"]);
				$lastName = trim($_POST["contactLastName"]);
				$firstEmail = trim($_POST["firstEmail"]);
				$secondEmail = trim($_POST["secondEmail"]);
				$firstPassword = trim($_POST["firstPassword"]);
				$secondPassword = trim($_POST["secondPassword"]);
								
				if (is_null($firstEmail) || is_null($secondEmail) || is_null($firstPassword) || is_null($secondPassword)){
				    echo "<p class='error'>Please verify that all values were entered correctly on the <a href='./'>previous form.</a></p> <br>";
				} else if ($firstEmail != $secondEmail) {
				    echo "<p class='error'>Please verify that both emails match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else if ($firstPassword != $secondPassword) {
					echo "<p class='error'>Please verify that both passwords match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else {
					//SQL insert First
					$checkEmailsSQL = "SELECT * FROM OrganizationInfo WHERE (email = '" . $firstEmail . "');";
					$stepTwo = mysqli_query($conn, $checkEmailsSQL);		
					if (mysqli_num_rows($stepTwo) > 0) {
						echo "<br><p>We're sorry, that email already has an account.</p>";
					} else {
						$passwordHash = password_hash($firstPassword, PASSWORD_DEFAULT);

						$insertInfoSQL = "insert into OrganizationInfo (organization, email, password, firstName, lastName)
						VALUES('" . $organizationName . "', '" . $firstEmail . "', '" . $passwordHash . "', '" . $firstName . "', '" . $lastName . "' );" ;
						if ($conn->query($insertInfoSQL) === TRUE) {
							echo "<h2>Welcome to Love Connections!</h2>";
							echo "<br><p>An email was sent to " . $firstEmail . ". Please follow the link to activate your account.</p>";
							echo "<p>If you did not recieve an email, click here.</p>";
						} else {
							echo "<p>Unfortunately an error occured. Please go back and reenter your information</p>";
						}
					}
				}
			} else {
				
				$firstName = trim($_POST["firstName"]);
				$lastName = trim($_POST["lastName"]);
				$firstEmail = trim($_POST["firstEmail"]);
				$secondEmail = trim($_POST["secondEmail"]);
				$firstPassword = trim($_POST["firstPassword"]);
				$secondPassword = trim($_POST["secondPassword"]);
								
				if (is_null($firstEmail) || is_null($secondEmail) || is_null($firstPassword) || is_null($secondPassword)){
				    echo "<p class='error'>Please verify that all values were entered correctly on the <a href='./'>previous form.</a></p> <br>";
				} else if ($firstEmail != $secondEmail) {
				    echo "<p class='error'>Please verify that both emails match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else if ($firstPassword != $secondPassword) {
					echo "<p class='error'>Please verify that both passwords match on the <a href='javascript:history.back()'>previous form.</a></p> <br>";
				} else {
					//SQL insert First
					$checkEmailsSQL = "SELECT * FROM MemberInfo WHERE (email = '" . $firstEmail . "');";
					$stepTwo = mysqli_query($conn, $checkEmailsSQL);		
					if (mysqli_num_rows($stepTwo) > 0) {
						echo "<br><p>We're sorry, that email already has an account.</p>";
					} else {
						$passwordHash = password_hash($firstPassword, PASSWORD_DEFAULT);
						$insertInfoSQL = "insert into MemberInfo (email, password, firstName, lastName)
						VALUES('" . $firstEmail . "', '" . $passwordHash . "', '" . $firstName . "', '" . $lastName . "' );" ;
						if ($conn->query($insertInfoSQL) === TRUE) {
							echo "<h2>Welcome to Love Connections!</h2>";
							echo "<br><p>An email was sent to " . htmlspecialchars($firstEmail) . ". Please follow the link to activate your account.</p>";
							echo "<p>If you did not recieve an email, click here.</p>";
						} else {
							echo "<p>Unfortunately an error occured. Please go back and reenter your information</p>";
						}
					}
				}
			}
			
			?> 	</div>
  </body>
</html>