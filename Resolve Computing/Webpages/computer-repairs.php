<?php require 'Functionality/item-functionality.php'; ?>

<html>

  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <center>
      <a href="computer-repairs.php"><img class="specific-item" src="../Images/computer-repairs-img.png"></a>
    </center>

    <?php include 'Includes/services-table-header.php'; ?>

    <?php	$service_array = $db_handle->runQuery("SELECT * FROM services WHERE category = 'computerrepairs' ORDER BY id ASC"); ?>

    <?php $service ='computer-repairs'; ?>

    <?php include 'Includes/services-data.php'; ?>

  </body>

</html>
