<?php require 'Functionality/item-functionality.php'; ?>

<html>

  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <center>
      <a href="performance-tuning.php"><img class="specific-item" src="../Images/performance-tuning-img.png"></a>
    </center>

    <?php include 'Includes/services-table-header.php'; ?>

    <?php $service_array = $db_handle->runQuery("SELECT * FROM services WHERE category = 'performancetuning' ORDER BY id ASC"); ?>

    <?php $service ='performance-tuning'; ?>

    <?php include 'Includes/services-data.php'; ?>

  </body>

</html>
