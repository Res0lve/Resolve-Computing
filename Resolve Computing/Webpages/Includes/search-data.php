<?php
  session_start(); //start session

  if(isset($_POST["search-submit"])) {
    $dbSearch = $_POST["search-term"];

    if (empty($dbSearch)) {
      header("Location:../search.php?error=emptysearchfield");
      exit();
    } else {
      require_once 'Includes/database.php';

      $query = "SELECT name, category, image FROM products WHERE name like '%$dbSearch%' or category like '%$dbSearch%' union SELECT name, category, image FROM services WHERE name like '%$dbSearch%' or category like '%$dbSearch%' ";
      $result = mysqli_query($conn, $query);

      while ($row=mysqli_fetch_assoc($result)) {
        $item_array[] = $row;
      }

      if (!empty($item_array)) { ?>
        <table class="item-table" cellpadding="16" cellspacing="0">
          <tr class="item-header">
            <th style="text-align:right;" width="4%">NAME</th>
            <th width="65%"></th>
            <th style="text-align:left;" width="10%">CATEGORY</th>
          </tr>
        </table>

  <?php foreach($item_array as $key=>$value){ ?>
          <div class="item-row">
            <div class="item-column"><img class="service-image" src="<?php echo $item_array[$key]["image"]; ?>">
              <div class="item-title"><?php echo $item_array[$key]["name"]; ?></div>
            </div>
              <div class="item-category"><?php echo ucfirst($item_array[$key]["category"]); ?></div>
          </div>
    <?php
        }
      } else {
        echo "NO ITEMS";
      }
    }
  }
?>
