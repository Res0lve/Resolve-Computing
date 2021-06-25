<?php require 'Functionality/item-functionality.php'; ?>

<html>

  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <center>
      <a href="system-unit.php"><img class="specific-item" src="../Images/systemunit-img.png"></a>
    </center>

    <?php include 'Includes/products-table-header.php'; ?>

    <div>
      <?php $product ='system-unit'; ?>
      <?php include 'Includes/products-data.php'; ?>
    </div>
  </body>
</html>
