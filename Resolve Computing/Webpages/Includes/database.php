<?php
    //Simple database connection code
    $dbHost = "localhost"; // if using webserver need to change to webserver name
    $dbUser = "root";
    $dbPass = "";
    $dbName = "resolvedatabase";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); // connection to database
?>
