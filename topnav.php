<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="jquery.nicescroll.js"></script>

  <script src="javaScriptMain.js" type="text/javascript"></script>
</head>

<?php

  $conn = mysqli_connect('localhost', 'root', '', 'loveConnections');
  if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
  }


  $email = "";
  $password = "";
  $email_err = "";
  $password_err = "";
  $id = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['email'])){

	  if (empty(trim($_POST["email"]))) {
		  $email_err = 'Please enter your email.';
	  } else {
		  $email = trim($_POST["email"]);
	  }

	  if (empty(trim($_POST["password"]))) {
		  $password_err = 'Please enter your password.';
	  } else {
		  $password = trim($_POST["password"]);
	  }

	  if (empty($email_err) && empty($password_err)) {
      $sql = "select memberID_PK, email, `password` FROM memberInfo WHERE email = ?;";

      $stmt = loginCheck($conn, $sql, $id, $email, $password);

      mysqli_stmt_close($stmt);
	  }
	  mysqli_close($conn);
  }

function loginCheck($conn, $sql, $id, $email, $password) {
  if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        if (mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);

          if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);

            if (mysqli_stmt_fetch($stmt)){

              if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                header("location: welcome.php");

              } else {
                $password_err = "The password you entered was not valid.";
                echo "<script type='text/javascript'>alert('$password_err');</script>";
              }
            }
          } else {
            $email_err = "Sorry, we can't find that email.";
            echo "<script type='text/javascript'>alert(' . $email_err . ');</script>";
          }
        } else {
          echo "Sorry, something went wrong! Try again!";
        }
      } else {
        echo "problems";
        die(mysqli_error($conn));
      }
      return($stmt);
}

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){ ?>
   <header class="container-fluid">
	  <div class="topnav">
	    <h1 class="col-md-6 col-sm-6 siteName"><a href='homepage.php'>Love Connections</a></h1>
		<nav class="col-md-6 col-sm-6" id="siteNav">
		  <li><a href='HowItWorks.php'>How It Works</a></li>
		  <li><a href='AboutUs.php'>About Us</a></li>
		  <li><a href='SignUpPage.php'>Sign Up</a></li>
		  <li id="login"><a id="login-trigger">Log in</a>
      <div id="login-content">
        <form action="topnav.php" method="post">

          <fieldset id="inputs">
            <input id="email" class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>" type="email" name="email" placeholder="Your email address" required>
            <span class="help-block"><?php echo $email_err; ?></span>
            <input id="password" class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" type="password" name="password" placeholder="Password" required>
            <span class="help-block"><?php echo $password_err; ?></span>
          </fieldset>
          <fieldset id="actions">
            <input type="submit" id="submit" value="Log in">
          </fieldset>
          <p>Don't have an account? </p>
          <a href="signUpPage.php">Sign up now</a>.
        </form>
      </div>


          </li>
		</nav>
      </div>
	</header>
<?php
} else { ?>
	<header class="container-fluid">
	  <div class="topnav">
	    <h1 class="col-md-6 col-sm-6 siteName"><a href='welcome.php'>Love Connections</a></h1>
		  <nav class="col-sm-offset-4 col-md-2 col-sm-2" id="siteNav">
  		  <li id="changeSettings"><a href="changeSettings.php">Change Settings</a></li>
		    <li id="logout"><a href="#" data-toggle="modal" data-target="#logOutModal" id="logout-trigger">Log Out</a></li>
    </nav>
      </div>
	</header>


    <div id="logOutModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Log Out?</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to log out?</p>
          </div>
          <div class="modal-footer">
            <a href="logout.php" type="button" class="btn btn-default" id="logOut">Log Out</a>
            <button type="button" class="btn btn-default" id="dismiss" data-dismiss="modal">Never Mind</button>
          </div>
        </div>

      </div>
    </div>
<?php
}
?>
