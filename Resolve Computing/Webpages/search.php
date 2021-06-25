<html>
  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <div class="function-content">
      <center><i style="color: #0c95ad" class="fa fa-search fa-10x"></i></center>
      <div class="function-title"> Search Page </div>
      <center><p> Enter a search term </p></center>
    </div>

    <form class="search-bar" method="post" action="search.php" style="margin:auto;max-width:300px">
      <input type="text" placeholder="Search.." name="search-term">
      <button type="submit" name="search-submit"><i class="fa fa-search"></i></button>
    </form>

    <div>
      <?php include 'Includes/search-data.php'; ?>
    </div>
  </body>
</html>
