<?php
  if (isset($_POST ['submit'])) {
    //Add database connection
    $dbHost = "localhost"; // if using webserver need to change to webserver name
    $dbUser = "root";
    $dbPass = "";
    $dbName = "resolvedb";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); // connection to database

    if (!$conn) {
      die("Database connection failed!");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $retypepassword = $_POST['retype-password'];
    $email = $_POST['email'];

    if (empty($username) || empty($password) || empty($retypepassword)) {
      header("Location:../register.php?error=emptyfield&username" . $username);
      exit();
    } elseif (strlen($username) < 6 || strlen($username) > 15 || strlen($password) < 6 || strlen($password) > 15) {
      header("Location:../register.php?error=usernameorpasswordlengtherror");
      exit();
    } elseif($password !== $retypepassword) {
      header("Location:../register.php?error=passwordsdonotmatch&username=" . $username);
      exit();
    } else {
      $sql = "SELECT username FROM users WHERE username = ?";
      $stmt = mysqli_stmt_init($conn); //statement

      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../register.php?error=databaseerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);

        if ($rowCount > 0) {
          header("Location:../register.php?error=usernameoremailtaken");
          exit();
        } else {
          $sql = "INSERT INTO users (username, password, email) VALUES (? , ?, ?)";

          $stmt = mysqli_stmt_init($conn); //statement

          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../register.php?error=databaseerror");
            exit();
          } else {
              $hashedPass = password_hash($password, PASSWORD_DEFAULT);

              mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $email);
              mysqli_stmt_execute($stmt);

              header("Location:../register.php?success=registered");
              exit();
            }
          }
        }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }
  }
?>
