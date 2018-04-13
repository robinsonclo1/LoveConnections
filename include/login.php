<?php

  require 'connection.php';

  $email = "";
  $password = "";
  $email_err = "";
  $password_err = "";
  $id = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST"){

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
                header("location: ../postLogin/welcome.php");

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
?>
