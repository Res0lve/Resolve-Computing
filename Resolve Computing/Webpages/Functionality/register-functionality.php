<?php
  if (isset($_POST['submit'])) {
    //Add database connection
    require_once '../Includes/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $retypepassword = $_POST['retype-password'];
    $email = $_POST['email'];

    if (empty($username) || empty($password) || empty($retypepassword)) {
      header("Location:../register.php?error=emptyfield&username");
      exit();
    } elseif (strlen($username) < 6 || strlen($username) > 15 || strlen($password) < 6 || strlen($password) > 15) {
      header("Location:../register.php?error=usernameorpasswordlengtherror");
      exit();
    } elseif($password !== $retypepassword) {
      header("Location:../register.php?error=passwordsdonotmatch&username=" . $username);
      exit();
    } else {
      $stmt = mysqli_stmt_init($conn); //statement

      if (mysqli_connect_error()) {
        die("Database connection failed!");
        header("Location:../register.php?error=databaseerror1");
        exit();
      } else { //username check
        $stmt = $conn->prepare("SELECT username FROM users WHERE username= ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);

        if ($rowCount > 0) {
          header("Location:../register.php?error=usernametaken");
          exit();
        } else { //email check
          $stmt = $conn->prepare("SELECT email FROM users WHERE email= ?");
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $rowCount = mysqli_stmt_num_rows($stmt);

          if ($rowCount > 0) {
            header("Location:../register.php?error=emailtaken");
            exit();
          } else {
            $stmt = mysqli_stmt_init($conn); //statement

            if (mysqli_connect_error()) {
              die("Database connection failed!");
              header("Location:../register.php?error=databaseerror2");
              exit();
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $email);
                mysqli_stmt_execute($stmt);

                header("Location:../register.php?success=registered"); 
                exit();
            }
          }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  } else {
    header("Location:../register.php?error=accessnotallowed");
    exit();
  }
?>
