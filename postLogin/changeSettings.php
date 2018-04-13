<?php
  require '../include/connection.php';
  require '../include/session.php';
  require "../include/topnav.php";
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

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
$firstPassword = trim($_POST["newFirstPassword"]);
$secondPassword = trim($_POST["newSecondPassword"]);

if (is_null($firstPassword) || is_null($secondPassword)){
    echo "<script type='text/javascript'>alert('Please verify that all values were entered correctly.');</script>";
} else if ($firstPassword != $secondPassword) {
  echo "<script type='text/javascript'>alert('Please verify that both passwords match.');</script>";
} else {
  //SQL insert First
  $passwordHash = password_hash($firstPassword, PASSWORD_DEFAULT);
  $id = $_SESSION['id'];
  $insertInfoSQL = "UPDATE MemberInfo set password = '$passwordHash' WHERE memberID_PK = $id;";

  if ($conn->query($insertInfoSQL) === TRUE) {
    echo "<script type='text/javascript'>alert('Password Changed');</script>";
  } else {
    echo "<script type='text/javascript'>alert('An unforseen error arose. The world will explode in 3...2...1...');</script>";
  }

}
}
 ?>
