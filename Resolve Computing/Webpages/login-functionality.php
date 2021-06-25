<?php
  if (isset($_POST['submit'])) {
    require 'Includes/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
      header("Location:../Webpages/login.php?error=emptyfield");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = mysqli_stmt_init($conn); //statement

      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../Webpages/login.php?error=databaseerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['sessionId'] = $row['id'];
            $_SESSION['sessionUser'] = $row['username'];
            $_SESSION['sessionEmail'] = $row['email'];

            header("Location:../index.php?success=loggedin");
            exit();
          } else {
            header("Location:../Webpages/login.php?error=wrongpasswordorusername");
            exit();
          }
        }
      }
    } else {
    header("Location:../Webpages/login.php?error=accessnotallowed");
    exit();
  }
?>
