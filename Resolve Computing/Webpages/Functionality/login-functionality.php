<?php
  if (isset($_POST['submit'])) {
    require_once '../Includes/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
      header("Location:../login.php?error=emptyfield");
      exit();
    } else {
      $stmt = mysqli_stmt_init($conn); //statement

      if (mysqli_connect_error()) {
        die("Database connection failed!");
        header("Location:../login.php?error=databaseerror");
        exit();
      } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username= ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['sessionId'] = $row['id'];
            $_SESSION['sessionUser'] = $row['username'];
            $_SESSION['sessionEmail'] = $row['email'];
            $_SESSION['sessionStatus'] = true;

            header("Location:../../index.php?success=loggedin");
            exit();
          } else {
            header("Location:../login.php?error=wrongpasswordorusername");
            exit();
          }
        }
      }
    } else {
    header("Location:../login.php?error=accessnotallowed");
    exit();
  }
?>
